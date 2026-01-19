<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display the careers index page.
     */
    public function index()
    {
        $jobOpenings = [
            [
                'title' => 'Executive Housekeeper',
                'location' => 'Multiple Locations',
                'type' => 'Full-time',
                'slug' => 'executive-housekeeper'
            ],
            [
                'title' => 'Full-time Housekeeper',
                'location' => 'Multiple Locations',
                'type' => 'Full-time',
                'slug' => 'full-time-housekeeper'
            ],
            [
                'title' => 'Inbound Sales Representative and Customer Support',
                'location' => 'Remote/Office',
                'type' => 'Full-time',
                'slug' => 'inbound-sales-representative-and-customer-support'
            ],
            [
                'title' => 'Team Leader',
                'location' => 'Multiple Locations',
                'type' => 'Full-time',
                'slug' => 'team-leader'
            ]
        ];

        return view('careers.index', compact('jobOpenings'));
    }

    /**
     * Display the executive housekeeper job page.
     */
    public function executiveHousekeeper()
    {
        $job = [
            'title' => 'Executive Housekeeper',
            'location' => 'Multiple Locations',
            'type' => 'Full-time',
            'salary' => '$45,000 - $55,000 annually',
            'description' => 'We are looking for an experienced Executive Housekeeper to oversee our cleaning operations...',
            'requirements' => [
                '3+ years of housekeeping experience',
                'Leadership and management skills',
                'Excellent attention to detail',
                'Valid driver\'s license',
                'Ability to work flexible hours'
            ]
        ];

        return view('careers.job-detail', compact('job'));
    }

    /**
     * Display the full-time housekeeper job page.
     */
    public function fullTimeHousekeeper()
    {
        $job = [
            'title' => 'Full-time Housekeeper',
            'location' => 'Multiple Locations',
            'type' => 'Full-time',
            'salary' => '$15 - $20 per hour',
            'description' => 'Join our team as a Full-time Housekeeper and help maintain clean, comfortable spaces...',
            'requirements' => [
                '1+ years of cleaning experience preferred',
                'Reliable transportation',
                'Physical ability to perform cleaning tasks',
                'Professional attitude',
                'Background check required'
            ]
        ];

        return view('careers.job-detail', compact('job'));
    }

    /**
     * Display the sales representative job page.
     */
    public function salesRepresentative()
    {
        $job = [
            'title' => 'Inbound Sales Representative and Customer Support',
            'location' => 'Remote/Office',
            'type' => 'Full-time',
            'salary' => '$35,000 - $45,000 annually + commission',
            'description' => 'We are seeking a motivated Sales Representative to handle inbound leads and provide customer support...',
            'requirements' => [
                'Excellent communication skills',
                'Sales experience preferred',
                'Customer service experience',
                'Computer proficiency',
                'Ability to work in fast-paced environment'
            ]
        ];

        return view('careers.job-detail', compact('job'));
    }

    /**
     * Display the team leader job page.
     */
    public function teamLeader()
    {
        $job = [
            'title' => 'Team Leader',
            'location' => 'Multiple Locations',
            'type' => 'Full-time',
            'salary' => '$18 - $22 per hour',
            'description' => 'Lead a team of housekeepers and ensure quality service delivery to our clients...',
            'requirements' => [
                '2+ years of cleaning experience',
                'Leadership experience',
                'Strong organizational skills',
                'Valid driver\'s license',
                'Ability to train and mentor team members'
            ]
        ];

        return view('careers.job-detail', compact('job'));
    }
}