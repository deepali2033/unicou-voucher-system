<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $freelancer = Auth::user();

        return view('freelancer.profile.show', compact('freelancer'));
    }

    public function update(Request $request)
    {
        $isPhotoOnlyUpdate = $request->hasFile('profile_photo') &&
            ! $request->has(['name', 'email', 'phone', 'address', 'city', 'state', 'zip_code', 'work_experience', 'education', 'certifications']);

        if ($isPhotoOnlyUpdate) {
            // Validate only profile photo
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
            ]);
        } else {
            // Full profile validation
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:15',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'zip_code' => 'nullable|string|max:20',
                'work_experience' => 'nullable|string',
                'education' => 'nullable|string',
                'certifications' => 'nullable|string',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'aadhar_card' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
                'pan_card' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            ]);
        }

        $freelancer = Auth::user();

        // Always save latitude/longitude if provided
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        if (!empty($latitude) && !empty($longitude)) {
            $freelancer->latitude = $latitude;
            $freelancer->longitude = $longitude;
        }

        if (! $isPhotoOnlyUpdate) {
            // Update basic fields
            $freelancer->name = $request->input('name');
            $freelancer->email = $request->input('email');
            $freelancer->phone = $request->input('phone');
            $freelancer->address = $request->input('address');
            $freelancer->city = $request->input('city');
            $freelancer->state = $request->input('state');
            $freelancer->zip_code = $request->input('zip_code');
            $freelancer->work_experience = $request->input('work_experience');
            $freelancer->education = $request->input('education');
            $freelancer->certifications = $request->input('certifications');

            // ---------------------------
            // Save latitude & longitude (client-side or server-side generated)
            // ---------------------------
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            // If coordinates not provided by client-side, try server-side geocoding
            if (empty($latitude) || empty($longitude)) {
                $fullAddress = implode(', ', array_filter([
                    $request->input('address'),
                    $request->input('city'),
                    $request->input('state'),
                    $request->input('zip_code'),
                ]));

                if (! empty($fullAddress)) {
                    try {
                        $url = 'https://nominatim.openstreetmap.org/search?q='.urlencode($fullAddress).'&format=json&limit=1';
                        $response = file_get_contents($url);
                        $data = json_decode($response, true);
                        if (! empty($data)) {
                            $latitude = $data[0]['lat'];
                            $longitude = $data[0]['lon'];
                        }
                    } catch (\Exception $e) {
                        // Optional: log error but don’t break update
                        \Log::error('Geocoding failed: '.$e->getMessage());
                    }
                }
            }

            // Save coordinates if we have them
            if (!empty($latitude) && !empty($longitude)) {
                $freelancer->latitude = $latitude;
                $freelancer->longitude = $longitude;
            }
        }

        // ---------------------------
        // Handle profile photo upload
        // ---------------------------
        if ($request->hasFile('profile_photo')) {
            if ($freelancer->profile_photo) {
                Storage::disk('public')->delete($freelancer->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $freelancer->profile_photo = $path;

            // Copy to public storage for immediate access (Windows workaround)
            $publicPath = public_path('storage/profile_photos');
            if (! file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            copy(storage_path('app/public/'.$path), public_path('storage/'.$path));
        }

        if (! $isPhotoOnlyUpdate) {
            // Handle other file uploads
            $files = [
                'resume' => 'documents/resumes',
                'cover_letter' => 'documents/cover_letters',
                'aadhar_card' => 'documents/kyc',
                'pan_card' => 'documents/kyc',
            ];

            foreach ($files as $field => $folder) {
                if ($request->hasFile($field)) {
                    if ($freelancer->$field) {
                        Storage::disk('public')->delete($freelancer->$field);
                    }
                    $freelancer->$field = $request->file($field)->store($folder, 'public');
                }
            }
        }

        $freelancer->save();

        return redirect()->route('freelancer.profile.show')->with('success', 'Profile updated successfully.');
    }
}
