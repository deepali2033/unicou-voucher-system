<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Str;

class DomesticController extends Controller
{
    public function domesticCleaning()
    {
        return $this->renderDomesticPage();
    }

    public function domesticCleaningPlace(string $citySlug)
    {
        return $this->renderDomesticPage($citySlug);
    }

    public function showFreelancer(string $citySlug, string $freelancerSlug)
    {
        $normalizedCitySlug = Str::startsWith($citySlug, 'city-') ? Str::after($citySlug, 'city-') : $citySlug;
        $slugBody = Str::startsWith($freelancerSlug, 'cleaner-') ? Str::after($freelancerSlug, 'cleaner-') : $freelancerSlug;
        $segments = explode('-', $slugBody);
        $freelancerIdSegment = array_shift($segments);

        if (! $freelancerIdSegment || ! ctype_digit($freelancerIdSegment)) {
            abort(404);
        }

        $freelancer = User::where('account_type', 'freelancer')->findOrFail((int) $freelancerIdSegment);
        $cityMatches = $freelancer->city && Str::slug($freelancer->city) === $normalizedCitySlug;

        if (! $cityMatches) {
            abort(404);
        }

        $expectedCitySlug = 'city-'.Str::slug($freelancer->city);
        $expectedSlug = $freelancer->cleanerProfileSlug();

        if ($citySlug !== $expectedCitySlug || $freelancerSlug !== $expectedSlug) {
            return redirect()->route('domestic-cleaning.places.cleaners.show', [
                'citySlug' => $expectedCitySlug,
                'freelancerSlug' => $expectedSlug,
            ]);
        }

        $relatedFreelancers = User::where('account_type', 'freelancer')
            ->whereNotNull('city')
            ->where('id', '!=', $freelancer->id)
            ->whereRaw('LOWER(city) = ?', [Str::lower($freelancer->city)])
            ->take(4)
            ->get();

        return view('domestic.cleanner-profile', [
            'freelancer' => $freelancer,
            'selectedCity' => $freelancer->city,
            'selectedState' => $freelancer->state,
            'relatedFreelancers' => $relatedFreelancers,
        ]);
    }

    protected function renderDomesticPage(?string $citySlug = null)
    {

        $services = Service::active()
            ->ordered()
            ->get();
        $freelancers = User::where('account_type', 'freelancer')
            ->whereNotNull('city')
            ->get();

        $freelancerCities = $freelancers->pluck('city')
            ->filter()
            ->unique()
            ->values();

        $selectedCity = null;
        $selectedState = null;
        $cityFreelancers = collect();

        if ($citySlug) {
            $normalizedSlug = Str::startsWith($citySlug, 'city-') ? Str::after($citySlug, 'city-') : $citySlug;

            $selectedCity = $freelancerCities->first(function ($city) use ($normalizedSlug) {
                return Str::slug($city) === $normalizedSlug;
            });

            if (! $selectedCity) {
                abort(404);
            }

            $cityFreelancers = $freelancers->filter(function ($freelancer) use ($normalizedSlug) {
                return Str::slug($freelancer->city) === $normalizedSlug;
            })->values();

            $selectedState = optional($cityFreelancers->first())->state;
        }

        return view('domestic.index', compact('services', 'freelancers', 'freelancerCities', 'selectedCity', 'selectedState', 'cityFreelancers'));
    }
}
