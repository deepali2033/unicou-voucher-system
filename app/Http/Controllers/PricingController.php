<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PricingController extends Controller
{
    /**
     * Display the pricing page.
     */
    public function index()
    {
        // Fetch the latest 4 active plans ordered by created_at
        $plans = Plan::active()
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get()
            ->map(function ($plan) {
                // Parse description to extract paragraphs and features
                $descriptionParts = explode("\n\n", $plan->description);
                $mainDescription = [];
                $features = [];

                foreach ($descriptionParts as $part) {
                    if (strpos($part, '•') !== false) {
                        // This part contains features
                        $featureLines = explode("\n", $part);
                        foreach ($featureLines as $line) {
                            $line = trim($line);
                            if (strpos($line, '•') !== false) {
                                $features[] = trim(str_replace('•', '', $line));
                            }
                        }
                    } else {
                        // This is a description paragraph
                        if (!empty(trim($part))) {
                            $mainDescription[] = trim($part);
                        }
                    }
                }

                // Parse points field if it exists
                if (!empty($plan->points)) {
                    $pointLines = explode("\n", $plan->points);
                    foreach ($pointLines as $line) {
                        $line = trim($line);
                        // Check for bullet points (•, -, *, or numbered lists)
                        if (!empty($line)) {
                            // Remove common bullet point markers
                            $cleanedLine = preg_replace('/^[•\-\*]\s*/', '', $line);
                            // Remove numbered list markers (1. 2. etc.)
                            $cleanedLine = preg_replace('/^\d+\.\s*/', '', $cleanedLine);
                            if (!empty(trim($cleanedLine))) {
                                $features[] = trim($cleanedLine);
                            }
                        }
                    }
                }

                // Take only first 2 description paragraphs for display
                // Include all features (from both description and points)
                $plan->parsed_descriptions = array_slice($mainDescription, 0, 2);
                $plan->parsed_features = $features;

                return $plan;
            });

        return view('pricing.index', compact('plans'));
    }
}
