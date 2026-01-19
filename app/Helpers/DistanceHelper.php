<?php

namespace App\Helpers;

class DistanceHelper
{
    /**
     * Calculate distance between two coordinates using Haversine formula
     * Returns distance in kilometers
     *
     * @param float $lat1 User latitude
     * @param float $lon1 User longitude
     * @param float $lat2 Freelancer latitude
     * @param float $lon2 Freelancer longitude
     * @return float Distance in kilometers
     */
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return round($distance, 2);
    }

    /**
     * Filter freelancers within radius
     *
     * @param float $userLat User latitude
     * @param float $userLon User longitude
     * @param \Illuminate\Database\Eloquent\Collection $freelancers
     * @param float $radiusKm Radius in kilometers (default: 500)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function filterFreelancersByRadius($userLat, $userLon, $freelancers, $radiusKm = 500)
    {
        if (!$userLat || !$userLon) {
            return $freelancers;
        }

        return $freelancers->filter(function ($freelancer) use ($userLat, $userLon, $radiusKm) {
            if (!$freelancer->latitude || !$freelancer->longitude) {
                return false;
            }

            $distance = self::calculateDistance($userLat, $userLon, $freelancer->latitude, $freelancer->longitude);
            return $distance <= $radiusKm;
        });
    }
}