@extends('layouts.app')

@php
    $locationParts = array_filter([$selectedCity ?? null, $selectedState ?? null]);
    $locationLabel = implode(', ', $locationParts);
    $pageTitle = trim(($freelancer->name ? $freelancer->name . ' - ' : '') . 'Domestic Cleaner' . ($locationLabel ? ' in ' . $locationLabel : ''));
    $metaDescription = ($freelancer->name ? $freelancer->name . ' delivers ' : 'Professional ') . 'domestic cleaning' . ($locationLabel ? ' in ' . $locationLabel : '') . ' with trusted service, flexible scheduling, and meticulous attention to detail.';
    $metaKeywords = implode(', ', array_filter([
        $freelancer->name ? $freelancer->name . ' cleaner' : null,
        $selectedCity ? $selectedCity . ' cleaning services' : null,
        'domestic cleaners',
        'professional housekeeping',
    ]));
    $profilePhotoPath = $freelancer->profile_photo ? 'storage/' . $freelancer->profile_photo : null;
    $hasPhoto = $profilePhotoPath && file_exists(public_path($profilePhotoPath));
    $profileImage = $hasPhoto ? asset($profilePhotoPath) : asset('images/placeholder.png');
    $verificationStatus = $freelancer->profile_verification_status === 'verified' ? 'Verified Cleaner' : ($freelancer->profile_verification_status === 'pending' ? 'Verification Pending' : 'Profile In Review');
    $statusClass = \Illuminate\Support\Str::slug($freelancer->profile_verification_status ?? 'pending');
    $citySlugValue = $freelancer->city ? 'city-' . \Illuminate\Support\Str::slug($freelancer->city) : null;
    $experienceSummary = $freelancer->work_experience ? \Illuminate\Support\Str::limit(strip_tags($freelancer->work_experience), 90) : null;
    $educationSummary = $freelancer->education ? \Illuminate\Support\Str::limit(strip_tags($freelancer->education), 90) : null;
    $certificationSource = is_array($freelancer->certifications) ? implode(', ', $freelancer->certifications) : $freelancer->certifications;
    $certificationsSummary = $certificationSource ? \Illuminate\Support\Str::limit(strip_tags($certificationSource), 90) : null;
    $phoneSanitized = $freelancer->phone ? preg_replace('/[^0-9+]/', '', $freelancer->phone) : null;
@endphp

@section('title', $pageTitle ?: 'Domestic Cleaner Profile')
@section('meta_description', $metaDescription)
@section('meta_keywords', $metaKeywords)

@section('content')
    <section class="cleaner-profile-wrapper">
        <div class="cleaner-profile-container">
            <div class="cleaner-breadcrumb">
                <a href="{{ route('domestic-cleaning') }}">Domestic Cleaning</a>
                @if($citySlugValue)
                    <span>/</span>
                    <a
                        href="{{ route('domestic-cleaning.places.show', ['citySlug' => $citySlugValue]) }}">{{ $selectedCity }}</a>
                @endif
                <span>/</span>
                <span>{{ $freelancer->name ?? 'Cleaner' }}</span>
            </div>

            <div class="cleaner-hero-card">
                <div class="cleaner-hero-image">
                    <img src="{{ $profileImage }}" alt="{{ $freelancer->name ?? 'Freelancer' }}">
                </div>
                <div class="cleaner-hero-content">
                    <span class="cleaner-status cleaner-status-{{ $statusClass }}">{{ $verificationStatus }}</span>
                    <h1>{{ $freelancer->name ?? 'Domestic Cleaner' }}</h1>
                    <p class="cleaner-location">{{ $locationLabel ?: 'Available nationwide' }}</p>
                    @if($freelancer->address)
                        <p class="cleaner-address">{{ $freelancer->address }}</p>
                    @endif
                    <div class="cleaner-meta">
                        <div>
                            <span class="meta-label">Experience</span>
                            <span class="meta-value">{{ $experienceSummary ?: 'Details provided during booking' }}</span>
                        </div>
                        <div>
                            <span class="meta-label">Education</span>
                            <span class="meta-value">{{ $educationSummary ?: 'Not specified' }}</span>
                        </div>
                        <div>
                            <span class="meta-label">Certifications</span>
                            <span class="meta-value">{{ $certificationsSummary ?: 'Available upon request' }}</span>
                        </div>
                    </div>
                    <div class="cleaner-hero-actions">
                        <a class="cleaner-btn primary-btn" href="{{ route('quote.index') }}">Book this cleaner</a>
                        @if($phoneSanitized)
                            <a class="cleaner-btn secondary-btn" href="tel:{{ $phoneSanitized }}">Call
                                {{ $freelancer->first_name ?? $freelancer->name ?? 'Cleaner' }}</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="cleaner-body">
                <div class="cleaner-body-main">
                    {{-- <section class="cleaner-section">
                        <h2>About {{ $freelancer->first_name ?? $freelancer->name ?? 'this cleaner' }}</h2>
                        @if($freelancer->work_experience)
                        <p>{!! nl2br(e($freelancer->work_experience)) !!}</p>
                        @else
                        <p>This trusted domestic cleaner brings meticulous attention to kitchens, bathrooms, living spaces,
                            and bedrooms, ensuring your home feels fresh after every visit.</p>
                        @endif
                    </section> --}}
                    {{--
                    <section class="cleaner-section">
                        <h2>Services you can expect</h2>
                        <ul class="cleaner-service-list">
                            <li>Room-by-room cleaning with careful dusting, vacuuming, and surface polishing.</li>
                            <li>Kitchen care that includes appliance wipe-downs, countertop sanitising, and sink refresh.
                            </li>
                            <li>Bathroom detailing with limescale removal, mirror shining, and floor disinfecting.</li>
                            <li>Optional extras such as laundry folding, internal window cleaning, and fridge refresh on
                                request.</li>
                        </ul>
                    </section> --}}

                    {{-- <section class="cleaner-section">
                        <h2>Credentials & background</h2>
                        <ul class="cleaner-detail-list">
                            <li>
                                <span>Background check</span>
                                <span>{{ $freelancer->profile_verification_status === 'verified' ? 'Completed' : 'In
                                    progress' }}</span>
                            </li>
                            @if($freelancer->education)
                            <li>
                                <span>Education</span>
                                <span>{{ $freelancer->education }}</span>
                            </li>
                            @endif
                            @if($certificationSource)
                            <li>
                                <span>Certifications</span>
                                <span>{{ $certificationSource }}</span>
                            </li>
                            @endif
                            @if($freelancer->pan_card)
                            <li>
                                <span>PAN document</span>
                                <span>Submitted</span>
                            </li>
                            @endif
                            @if($freelancer->aadhar_card || $freelancer->aadhaar_document_path)
                            <li>
                                <span>Aadhaar verification</span>
                                <span>Submitted</span>
                            </li>
                            @endif
                        </ul>
                    </section> --}}

                    <section class="cleaner-section">
                        <h2>Availability & travel</h2>
                        <div class="cleaner-availability">
                            <div>
                                <span>Primary city</span>
                                <p>{{ $selectedCity ?: 'Flexible' }}</p>
                            </div>
                            <div>
                                <span>Service radius</span>
                                <p>{{ $selectedCity ? 'Up to 10 miles around ' . $selectedCity : 'Discuss during booking' }}
                                </p>
                            </div>
                            <div>
                                <span>Preferred schedule</span>
                                <p>Weekdays and weekends with prior notice</p>
                            </div>
                        </div>
                    </section>
                </div>

                <aside class="cleaner-sidebar">
                    <!-- Profile Photo Card -->
                    @if($hasPhoto)
                        <div class="cleaner-profile-card">
                            <div class="cleaner-profile-card-image">
                                <img src="{{ $profileImage }}" alt="{{ $freelancer->name ?? 'Cleaner' }}">
                            </div>
                            <div class="cleaner-profile-card-body">
                                <div class="cleaner-profile-card-heading">
                                    <h3>{{ $freelancer->name ?? 'Cleaner' }}</h3>
                                    @if($freelancer->profile_verification_status === 'verified')
                                        <span class="cleaner-profile-badge">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                                                <path d="M9 12.5L11 14.5L15 10.5" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                                <p class="cleaner-profile-card-sub">Trusted domestic cleaner focused on spotless spaces.</p>
                                <div class="cleaner-profile-card-location">
                                    <span class="cleaner-profile-location-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12 21C12 21 5 14.75 5 10C5 6.68629 7.68629 4 11 4C14.3137 4 17 6.68629 17 10C17 14.75 12 21 12 21Z"
                                                stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.6" />
                                        </svg>
                                    </span>
                                    <div class="cleaner-profile-location-text">
                                        <span class="cleaner-profile-location-label">Address</span>
                                        <span
                                            class="cleaner-profile-location-value">{{ $freelancer->address ?: ($locationLabel ?: 'Address available after booking') }}</span>
                                    </div>
                                </div>
                                <a class="cleaner-profile-card-btn" href="{{ url()->current() }}">View profile</a>
                            </div>
                        </div>
                    @endif

                    <div class="sidebar-card">
                        <h3>Key details</h3>
                        <ul>
                            <li>
                                <span>Location</span>
                                <span>{{ $locationLabel ?: 'Remote' }}</span>
                            </li>
                            @if($freelancer->zip_code)
                                <li>
                                    <span>Postcode</span>
                                    <span>{{ $freelancer->zip_code }}</span>
                                </li>
                            @endif
                            @if($freelancer->phone)
                                <li>
                                    <span>Phone</span>
                                    <span>{{ $freelancer->phone }}</span>
                                </li>
                            @endif
                            @if($freelancer->profile_verification_status)
                                <li>
                                    <span>Status</span>
                                    <span>{{ ucfirst(str_replace('_', ' ', $freelancer->profile_verification_status)) }}</span>
                                </li>
                            @endif
                        </ul>
                        <a class="sidebar-btn" href="{{ route('quote.index') }}">Request a quote</a>
                    </div>

                    <div class="sidebar-card secondary">
                        <h3>Need help?</h3>
                        <p>Our concierge team can match you with the right cleaner for deep cleans, recurring visits, or
                            move-in support.</p>
                        <a class="sidebar-btn outlined" href="{{ route('contact.index') }}">Contact support</a>
                    </div>
                </aside>
            </div>

            @if($relatedFreelancers->isNotEmpty())
                <section class="cleaner-related">
                    <div class="section-header">
                        <h2>More cleaners near {{ $selectedCity }}</h2>
                        @if($citySlugValue)
                            <a class="view-all-link"
                                href="{{ route('domestic-cleaning.places.show', ['citySlug' => $citySlugValue]) }}">View all
                                cleaners</a>
                        @endif
                    </div>
                    <div class="related-grid">
                        @foreach($relatedFreelancers as $relatedFreelancer)
                            @php
                                $relatedCitySlug = $relatedFreelancer->city ? 'city-' . \Illuminate\Support\Str::slug($relatedFreelancer->city) : null;
                                $relatedUrl = $relatedCitySlug ? route('domestic-cleaning.places.cleaners.show', ['citySlug' => $relatedCitySlug, 'freelancerSlug' => $relatedFreelancer->cleanerProfileSlug()]) : route('domestic-cleaning');
                                $relatedPhotoPath = $relatedFreelancer->profile_photo ? 'storage/' . $relatedFreelancer->profile_photo : null;
                                $hasRelatedPhoto = $relatedPhotoPath && file_exists(public_path($relatedPhotoPath));
                                $relatedImage = $hasRelatedPhoto ? asset($relatedPhotoPath) : asset('images/placeholder.png');
                                $relatedLocation = implode(', ', array_filter([$relatedFreelancer->city, $relatedFreelancer->state]));
                            @endphp
                            <a class="related-card" href="{{ $relatedUrl }}">
                                <div class="related-image">
                                    <img src="{{ $relatedImage }}" alt="{{ $relatedFreelancer->name ?? 'Cleaner' }}">
                                </div>
                                <div class="related-content">
                                    <h3>{{ $relatedFreelancer->name ?? 'Cleaner' }}</h3>
                                    <p>{{ $relatedLocation ?: 'Location on request' }}</p>
                                    <span
                                        class="related-status">{{ ucfirst(str_replace('_', ' ', $relatedFreelancer->profile_verification_status ?? 'pending')) }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .cleaner-profile-wrapper {
            padding: 140px 0 80px;
            background: linear-gradient(180deg, rgba(232, 245, 211, 0.8) 0%, #ffffff 45%);
        }

        .cleaner-profile-container {
            width: min(1100px, 92%);
            margin: 0 auto;
        }

        .cleaner-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            margin-bottom: 30px;
            color: #5a6473;
        }

        .cleaner-breadcrumb a {
            color: var(--e-global-color-vamtam_accent_2, #3CA200);
            text-decoration: none;
            font-weight: 600;
        }

        .cleaner-hero-card {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 40px;
            background: #ffffff;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 24px 60px rgba(31, 57, 107, 0.15);
            margin-bottom: 48px;
        }

        .cleaner-hero-image img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(17, 38, 89, 0.25);
        }

        .cleaner-hero-content h1 {
            font-size: clamp(28px, 3vw, 36px);
            margin: 12px 0;
            color: #0d2445;
        }

        .cleaner-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            background: rgba(60, 162, 0, 0.12);
            color: var(--e-global-color-vamtam_accent_2, #3CA200);
        }

        .cleaner-status-verified {
            background: rgba(45, 181, 93, 0.14);
            color: #1a8f4d;
        }

        .cleaner-status-pending,
        .cleaner-status-verification-pending {
            background: rgba(255, 193, 59, 0.18);
            color: #d48806;
        }

        .cleaner-status-rejected {
            background: rgba(237, 60, 80, 0.18);
            color: #c0392b;
        }

        .cleaner-location {
            font-size: 18px;
            color: #2f3f59;
            font-weight: 600;
        }

        .cleaner-address {
            margin-top: 6px;
            color: #738198;
        }

        .cleaner-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 14px;
            margin: 24px 0;
        }

        .cleaner-meta div {
            background: #F4F6F0;
            border-radius: 16px;
            padding: 14px 16px;
        }

        .meta-label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #6b7a99;
            margin-bottom: 6px;
        }

        .meta-value {
            font-weight: 600;
            color: #1a2f4b;
        }

        .cleaner-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .cleaner-btn {
            padding: 14px 22px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .primary-btn {
            background: var(--e-global-color-vamtam_accent_2, #3CA200);
            color: #ffffff;
            box-shadow: 0 14px 30px rgba(60, 162, 0, 0.25);
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(60, 162, 0, 0.28);
        }

        .secondary-btn {
            background: rgba(60, 162, 0, 0.12);
            color: var(--e-global-color-vamtam_accent_2, #3CA200);
        }

        .secondary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 32px rgba(60, 162, 0, 0.16);
        }

        .cleaner-body {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 30px;
        }

        .cleaner-section {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px 30px;
            box-shadow: 0 20px 48px rgba(17, 38, 89, 0.08);
            margin-bottom: 26px;
        }

        .cleaner-section h2 {
            font-size: 24px;
            margin-bottom: 16px;
            color: #14274d;
        }

        .cleaner-section p {
            color: #475773;
            line-height: 1.7;
        }

        .cleaner-service-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 14px;
        }

        .cleaner-service-list li {
            background: rgba(60, 162, 0, 0.08);
            color: #1a2f4b;
            padding: 14px 18px;
            border-radius: 16px;
            font-weight: 500;
        }

        .cleaner-detail-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 12px;
        }

        .cleaner-detail-list li {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 18px;
            border-radius: 14px;
            background: #F4F6F0;
            color: #1f2f4b;
            font-weight: 500;
        }

        .cleaner-detail-list span:first-child {
            color: #6b7a99;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .cleaner-availability {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 18px;
        }

        .cleaner-availability div {
            background: #F4F6F0;
            padding: 18px;
            border-radius: 18px;
        }

        .cleaner-availability span {
            display: block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6f7c93;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .cleaner-availability p {
            margin: 0;
            color: #1d2f4c;
            font-weight: 600;
        }

        .cleaner-sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .profile-photo-card {
            background: linear-gradient(135deg, #3CA200 0%, #5FAD56 100%) !important;
            color: white !important;
            text-align: center;
            padding: 20px !important;
        }

        .profile-photo-card h4 {
            color: white !important;
            margin-bottom: 8px !important;
        }

        .profile-photo-card .cleaner-status {
            background: rgba(255, 255, 255, 0.2) !important;
            color: white !important;
            font-size: 11px !important;
            padding: 4px 8px !important;
        }

        .sidebar-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 20px 48px rgba(12, 37, 89, 0.08);
        }

        .sidebar-card h3 {
            font-size: 20px;
            margin-bottom: 16px;
            color: #172a4e;
        }

        .sidebar-card ul {
            list-style: none;
            padding: 0;
            margin: 0 0 22px 0;
            display: grid;
            gap: 12px;
        }

        .sidebar-card ul li {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            font-weight: 500;
            color: #1f2f4b;
        }

        .sidebar-card ul li span:first-child {
            color: #6b7a99;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
        }

        .sidebar-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px 0;
            border-radius: 12px;
            text-decoration: none;
            fon background: var(--e-global-color-vamtam_accent_2, #3CA220);
            tion: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .sidebar-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 35px rgba(60, 162, 0, 0.24);
        }

        .cleaner-profile-location-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .cleaner-profile-location-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #93a0b6;
        }

        .cleaner-profile-location-value {
            font-size: 15px;
            font-weight: 600;
            color: #1c2f4d;
        }

        .sidebar-card.secondary {
            background: linear-gradient(150deg, rgba(60, 162, 0, 0.1), rgba(232, 245, 211, 0.18));
        }

        .sidebar-card.secondary p {
            color: #1f2f4b;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .sidebar-btn.outlined {
            background: transparent;
            border: 2px solid rgba(60, 162, 0, 0.4);
            color: var(--e-global-color-vamtam_accent_2, #3CA200);
        }

        .cleaner-related {
            margin-top: 60px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .section-header h2 {
            font-size: 26px;
            color: #0f2447;
        }

        .view-all-link {
            color: var(--e-global-color-vamtam_accent_2, #3CA200);
            font-weight: 600;
            text-decoration: none;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
        }

        .related-card {
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 18px 42px rgba(16, 36, 87, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 52px rgba(16, 36, 87, 0.14);
        }

        .related-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .related-content {
            padding: 18px 20px;
        }

        .related-content h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #14274d;
        }

        .related-content p {
            margin: 0 0 10px 0;
            color: #5a6473;
            font-weight: 500;
        }

        .related-status {
            display: inline-flex;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(60, 162, 0, 0.12);
            color: var(--e-global-color-vamtam_accent_2, #3CA200);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        @media (max-width: 1024px) {
            .cleaner-hero-card {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .cleaner-hero-image img {
                height: 260px;
            }

            .cleaner-meta {
                justify-items: center;
            }

            .cleaner-body {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .cleaner-profile-wrapper {
                padding: 110px 0 60px;
            }

            .cleaner-hero-card {
                padding: 24px;
            }

            .cleaner-hero-actions {
                flex-direction: column;
            }

            .cleaner-section {
                padding: 22px;
            }

            .cleaner-breadcrumb {
                flex-wrap: wrap;
            }
        }
    </style>
@endpush