<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Addressapi extends Controller
{
    /**
     * Get address suggestions based on user input using PDOK (Dutch Government Free API)
     * Used for autocomplete functionality in booking form
     */
    public function getAddressSuggestions(Request $request)
    {
        $search = $request->query('q', '');

        \Log::info('Address search query', ['search' => $search]);

        if (strlen($search) < 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter at least 3 characters',
                'suggestions' => [],
            ]);
        }

        $cacheKey = 'address_suggestions_' . md5($search);
        
        if (\Cache::has($cacheKey)) {
            \Log::info('Returning cached address suggestions', ['search' => $search]);
            return response()->json(\Cache::get($cacheKey));
        }

        $suggestions = [];

        try {
            $client = new Client([
                'timeout' => 15,
                'connect_timeout' => 10,
            ]);

            $nominatimUrl = 'https://nominatim.openstreetmap.org/search';
            
            $response = $client->get($nominatimUrl, [
                'query' => [
                    'q' => $search . ', Netherlands',
                    'format' => 'json',
                    'limit' => 10,
                    'addressdetails' => 1,
                    'countrycodes' => 'nl',
                ],
                'headers' => [
                    'User-Agent' => 'KOA-Services-Booking (contact: support@koaservices.nl)',
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            \Log::info('Nominatim API response', [
                'search' => $search,
                'results_count' => count($data ?? []),
            ]);

            if (is_array($data) && count($data) > 0) {
                foreach ($data as $item) {
                    $address = $item['display_name'] ?? '';
                    $addressDetails = $item['address'] ?? [];
                    
                    $city = $addressDetails['city'] ?? $addressDetails['town'] ?? $addressDetails['village'] ?? '';
                    $postalCode = $addressDetails['postcode'] ?? '';
                    
                    if (!empty($address)) {
                        $suggestions[] = [
                            'id' => $item['osm_id'] ?? null,
                            'address' => $address,
                            'city' => $city,
                            'postal_code' => $postalCode,
                            'country' => 'Netherlands',
                        ];
                    }
                }
            }

            $result = [
                'status' => 'success',
                'suggestions' => array_slice($suggestions, 0, 10),
            ];

            \Cache::put($cacheKey, $result, now()->addHours(24));

            return response()->json($result);

        } catch (\Exception $e) {
            \Log::error('Address suggestion error', [
                'search' => $search,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Unable to fetch address suggestions',
                'error' => config('app.debug') ? $e->getMessage() : null,
                'suggestions' => [],
            ], 500);
        }
    }

    private function extractCity($address)
    {
        $parts = explode(',', $address);
        return trim(end($parts));
    }

    private function extractPostalCode($address)
    {
        if (preg_match('/(\d{4}\s?[A-Z]{2})/', $address, $matches)) {
            return trim($matches[1]);
        }
        return '';
    }

    /**
     * Handle WordPress-style AJAX requests from Elementor/theme scripts
     * This replaces wp-admin/admin-ajax.php functionality
     */
    public function handleapi(Request $request)
    {
        // Get the action parameter (WordPress convention)
        // initiate client
        $apiKey = self::API_KEY;
        // In this example we made use of the Guzzle as HTTPClient.
        $client = new \FH\PostcodeAPI\Client(
            new Client([
                'headers' => [
                    'X-Api-Key' => $apiKey,
                ],
            ])
        );

        // call endpoints
        $response = $client->getAddresses('5041EB', 21);
        $response = $client->getAddress('0855200000061001');
        $response = $client->getPostcodeDataByPostcode('5041EB');
    }
}
