@extends('layouts.app')

@section('title', ($service?->meta_title) ?: 'Domestic Cleaning Services - KOA Service')
@section('meta_description', ($service?->meta_description) ?: 'Trusted domestic cleaning professionals delivering spotless results on your schedule.')

@php
    $serviceName = $service?->name ?: 'Domestic Cleaning';
    $heroSummary = $service?->short_description ?: 'Professional cleaners for spotless homes, flexible schedules, and transparent pricing tailored to your lifestyle.';
    $priceRange = $service ? ($service->price_range ?: 'Contact for pricing') : 'From €65 per visit';
    $duration = $service?->duration ?: '2-3 hours per visit';
    $serviceIncludes = $service?->includes ?: [
        'Kitchen surfaces degreased and sanitized',
        'Bathrooms disinfected and polished',
        'Dusting of furniture, fixtures, and skirting boards',
        'Vacuuming and mopping of all floors',
        'Bin liners replaced and rubbish removed'
    ];
    $serviceFeatures = $service?->features ?: [
        'Fully vetted and insured cleaners',
        'Eco-friendly products available on request',
        'Dedicated support team seven days a week',
        'Same cleaner for recurring bookings when possible',
        'Real-time updates and reminders'
    ];
    $plans = [
        [
            'title' => 'Regular Cleaning',
            'badge' => 'Most booked',
            'description' => 'Weekly or fortnightly upkeep for effortlessly tidy homes.',
            'price' => $service ? ($service->price_range ?: 'Tailored pricing') : 'From €55/visit',
            'cta' => route('book-services.index'),
        ],
        [
            'title' => 'One-Off Deep Cleaning',
            'badge' => 'Seasonal refresh',
            'description' => 'Intensive top-to-bottom clean ideal for busy households.',
            'price' => 'From €120/visit',
            'cta' => route('book-services.index'),
        ],
        [
            'title' => 'Move-In & Move-Out',
            'badge' => 'Landlord approved',
            'description' => 'Spotless results that secure deposits and wow new tenants.',
            'price' => 'Custom quote',
            'cta' => route('book-services.index'),
        ],
    ];
    $steps = [
        [
            'title' => 'Tell us about your home',
            'text' => 'Select property size, preferred date, and any special requests.',
        ],
        [
            'title' => 'Match with a cleaner',
            'text' => 'We confirm availability and share cleaner details before arrival.',
        ],
        [
            'title' => 'Relax while we clean',
            'text' => 'Enjoy a sparkling home and manage bookings in your dashboard.',
        ],
    ];
    $addons = [
        'Inside fridge and oven detailing',
        'Interior window and glass polishing',
        'Laundry folding and ironing assistance',
        'Bed linen change and mattress refresh',
        'Balcony or patio sweeping',
    ];
    $benefits = [
        [
            'title' => 'Flexible scheduling',
            'text' => 'Book same-day or plan ahead with morning, afternoon, or evening slots.',
        ],
        [
            'title' => 'Top-rated professionals',
            'text' => 'Only 4.8★+ rated cleaners remain on the KOA platform after continuous reviews.',
        ],
        [
            'title' => 'Safe & secure',
            'text' => 'Background checks, identity verification, and comprehensive public liability insurance.',
        ],
        [
            'title' => 'Supplies handled',
            'text' => 'Bring your own kit or request eco-friendly products at checkout.',
        ],
    ];
    $ukCoverageGroups = [
        [
            'title' => 'KOA pros cover these towns and nearby neighbourhoods:',
            'locations' => [
                ['key' => 'sheffield', 'label' => 'Sheffield'],
                ['key' => 'preston', 'label' => 'Preston'],
                ['key' => 'bedford', 'label' => 'Bedford'],
                ['key' => 'warwick', 'label' => 'Warwick'],
                ['key' => 'orpington', 'label' => 'Orpington'],
                ['key' => 'chislehurst', 'label' => 'Chislehurst'],
                ['key' => 'northfield', 'label' => 'Northfield'],
                ['key' => 'west-wickham', 'label' => 'West Wickham'],
                ['key' => 'beverley', 'label' => 'Beverley'],
                ['key' => 'cleveland', 'label' => 'Cleveland'],
            ],
        ],
        [
            'title' => 'We currently serve homeowners in:',
            'locations' => [
                ['key' => 'london', 'label' => 'London'],
                ['key' => 'bristol', 'label' => 'Bristol'],
                ['key' => 'birmingham', 'label' => 'Birmingham'],
                ['key' => 'manchester', 'label' => 'Manchester'],
                ['key' => 'leeds', 'label' => 'Leeds'],
                ['key' => 'liverpool', 'label' => 'Liverpool'],
                ['key' => 'coventry', 'label' => 'Coventry'],
                ['key' => 'croydon', 'label' => 'Croydon'],
                ['key' => 'milton-keynes', 'label' => 'Milton Keynes'],
                ['key' => 'luton', 'label' => 'Luton'],
                ['key' => 'chelmsford', 'label' => 'Chelmsford'],
                ['key' => 'slough', 'label' => 'Slough'],
            ],
        ],
    ];
    $ukLocationProfiles = [
        [
            'key' => 'london',
            'name' => 'London',
            'description' => 'Domestic cleaners across Zones 1-6 with weekday, evening, and weekend availability.',
            'highlights' => [
                '180+ vetted KOA cleaners ready within 24 hours',
                'Preferred cleaner option for recurring clients',
                'Eco-friendly supply upgrades anywhere in Greater London',
            ],
        ],
        [
            'key' => 'bristol',
            'name' => 'Bristol',
            'description' => 'From Clifton terraces to Harbourside apartments, our cleaners handle busy city schedules.',
            'highlights' => [
                '90-minute arrival windows across BS1-BS16',
                'Deep-clean packages for home moves and renovations',
                'Parking and access coordination handled by KOA support',
            ],
        ],
        [
            'key' => 'birmingham',
            'name' => 'Birmingham',
            'description' => 'Cleaning teams available throughout the West Midlands with flexible time slots.',
            'highlights' => [
                'Next-day slots in Jewellery Quarter, Edgbaston, and Solihull',
                'Trusted by landlords for check-in and check-out cleans',
                'All cleaners carry insurance and ID badges for peace of mind',
            ],
        ],
        [
            'key' => 'manchester',
            'name' => 'Manchester',
            'description' => 'Reliable domestic cleaners covering the city centre and commuter towns.',
            'highlights' => [
                'Same cleaner guarantee for weekly subscriptions',
                'Pet-friendly cleaning protocols on request',
                'Late-evening appointments ideal for shift workers',
            ],
        ],
        [
            'key' => 'leeds',
            'name' => 'Leeds',
            'description' => 'Support spanning student lets, suburban homes, and premium apartments.',
            'highlights' => [
                'Key pickup and drop-off available within LS postcodes',
                'Spotless guarantee with free revisits if needed',
                'Trusted by property managers for multi-unit schedules',
            ],
        ],
        [
            'key' => 'liverpool',
            'name' => 'Liverpool',
            'description' => 'Meticulous cleaning teams for city docks, Anfield, and Wirral households.',
            'highlights' => [
                'Weekend cleans for matchday rentals and serviced apartments',
                'Steam clean upgrades for kitchens and bathrooms',
                'Background-checked cleaners with 4.8★+ ratings',
            ],
        ],
        [
            'key' => 'coventry',
            'name' => 'Coventry',
            'description' => 'Ideal for family homes seeking consistent, trustworthy maintenance cleans.',
            'highlights' => [
                'Regular slots across CV1-CV8 with easy rescheduling',
                'Specialist support for allergy-aware households',
                'Transparent pricing with no weekend surcharge',
            ],
        ],
        [
            'key' => 'croydon',
            'name' => 'Croydon',
            'description' => 'Busy professionals rely on KOA for spotless flats from East to South Croydon.',
            'highlights' => [
                'Local cleaners with knowledge of gated developments',
                'After-hours cleans for office-to-home commutes',
                'Key safe and concierge coordination included',
            ],
        ],
        [
            'key' => 'milton-keynes',
            'name' => 'Milton Keynes',
            'description' => 'Flexible domestic cleaning for modern homes and new-build estates.',
            'highlights' => [
                'Tailored schedules for hybrid workers and families',
                'Add-on oven, fridge, and appliance detailing',
                'Back-to-back cleans for townhouse and duplex layouts',
            ],
        ],
        [
            'key' => 'luton',
            'name' => 'Luton',
            'description' => 'Airport staff and commuters count on KOA for dependable weekly cleans.',
            'highlights' => [
                'Arrival tracking with SMS reminders on clean day',
                'Rental changeover cleans turned around within 6 hours',
                'Inclusive of equipment when requested at booking',
            ],
        ],
        [
            'key' => 'chelmsford',
            'name' => 'Chelmsford',
            'description' => 'Comprehensive cleaning support across Essex market towns and villages.',
            'highlights' => [
                'Experienced teams for period homes and modern builds',
                'Sustainable cleaning products available upon request',
                'Dedicated concierge to manage keys and instructions',
            ],
        ],
        [
            'key' => 'slough',
            'name' => 'Slough',
            'description' => 'Perfect for busy households near Heathrow seeking reliable cleaners.',
            'highlights' => [
                'Covering Langley, Cippenham, and Windsor borders',
                'Express deep-clean teams for short notice bookings',
                'Digital checklists shared after every clean',
            ],
        ],
        [
            'key' => 'sheffield',
            'name' => 'Sheffield',
            'description' => 'From city penthouses to Peaks cottages, we deliver spotless results.',
            'highlights' => [
                'Trusted by holiday let hosts for rapid turnovers',
                'Non-toxic options suited for family homes and pets',
                'Flexible length appointments from two hours upwards',
            ],
        ],
        [
            'key' => 'preston',
            'name' => 'Preston',
            'description' => 'Domestic cleaners serving PR1-PR5 with simple online scheduling.',
            'highlights' => [
                'Guaranteed arrival windows to keep your day on track',
                'Optional laundry folding and ironing add-ons',
                'Community-vetted cleaners with DBS checks',
            ],
        ],
        [
            'key' => 'bedford',
            'name' => 'Bedford',
            'description' => 'Supporting riverside apartments and village homes nearby.',
            'highlights' => [
                'Recurring cleans with the same professional each visit',
                'Deep cleans timed around school and work schedules',
                'Secure payment and billing through the KOA portal',
            ],
        ],
        [
            'key' => 'warwick',
            'name' => 'Warwick',
            'description' => 'Reliable help for heritage homes and modern estates across Warwickshire.',
            'highlights' => [
                'Tailored cleaning plans for listed properties',
                'All equipment disinfected between bookings',
                'Responsive local support team seven days a week',
            ],
        ],
        [
            'key' => 'orpington',
            'name' => 'Orpington',
            'description' => 'South London and Kent borders covered with trusted domestic pros.',
            'highlights' => [
                'Dual cleaner teams for larger detached homes',
                'School-run friendly appointment slots',
                'Secure access via smart locks or concierge coordination',
            ],
        ],
        [
            'key' => 'chislehurst',
            'name' => 'Chislehurst',
            'description' => 'Discreet cleaning services ideal for premium residences.',
            'highlights' => [
                'Attention to detail for delicate finishes and surfaces',
                'Fully insured cleaners with professional uniforms',
                'Housekeeper-level services including linen changes',
            ],
        ],
        [
            'key' => 'northfield',
            'name' => 'Northfield',
            'description' => 'West Midlands teams supporting family homes and rentals.',
            'highlights' => [
                'Flexible frequency options from weekly to monthly',
                'Child-safe and pet-safe product alternatives',
                'Digital visit logs shared instantly after completion',
            ],
        ],
        [
            'key' => 'west-wickham',
            'name' => 'West Wickham',
            'description' => 'Preferred domestic cleaners for Bromley borough households.',
            'highlights' => [
                'Vacuum and mop equipment provided when requested',
                'Reliable cover cleans when your regular pro is away',
                'SMS updates when the cleaner is en route',
            ],
        ],
        [
            'key' => 'beverley',
            'name' => 'Beverley',
            'description' => 'Serving East Riding homes with meticulous attention.',
            'highlights' => [
                'Spring clean bundles with inside cabinet detailing',
                'Trusted by retirees for gentle, respectful service',
                'Flexible invoicing for multi-property owners',
            ],
        ],
        [
            'key' => 'cleveland',
            'name' => 'Cleveland',
            'description' => 'North East coverage for coastal and countryside properties.',
            'highlights' => [
                'Teams experienced with larger footprint family homes',
                'Upholstery refresh and carpet shampoo add-ons',
                'Weather-appropriate scheduling during winter months',
            ],
        ],
    ];
    $faqs = [
        [
            'question' => 'How soon can I book a domestic cleaner?',
            'answer' => 'Most bookings are confirmed within minutes. Same-day appointments are available in major service areas when booked before noon.',
        ],
        [
            'question' => 'Do I need to be home during the clean?',
            'answer' => 'No. Provide secure access instructions and enjoy updates through email or SMS while our vetted cleaner takes care of everything.',
        ],
        [
            'question' => 'Can I request the same cleaner each time?',
            'answer' => 'Yes. Recurring clients can keep their favourite professional when schedules align, ensuring consistent results and familiarity.',
        ],
        [
            'question' => 'What if I need to reschedule?',
            'answer' => 'Easily reschedule or cancel up to 24 hours before your appointment with no extra fees using your KOA account or by contacting support.',
        ],
    ];
    $reviews = [
        [
            'name' => 'Charlotte M.',
            'location' => 'Amsterdam Zuid',
            'text' => 'Flawless service. The team left my apartment spotless and even organised the nursery. I booked a recurring plan immediately.',
        ],
        [
            'name' => 'Jonas K.',
            'location' => 'Rotterdam',
            'text' => 'Professional, punctual, and detail-oriented. Booking and communication were effortless and transparent.',
        ],
        [
            'name' => 'Fiona L.',
            'location' => 'Utrecht',
            'text' => 'Loved the eco products option. My home smells fresh without harsh chemicals and the cleaners were so friendly.',
        ],
    ];
    $relatedServices = \App\Models\Service::active()
        ->where('slug', '!=', 'domestic-cleaning')
        ->ordered()
        ->limit(4)
        ->get();
@endphp

@section('content')
    <article class="domestic-page">
        <section class="domestic-hero">
            <div class="domestic-container">
                <div class="domestic-hero__grid">
                    <div class="domestic-hero__content">
                        <span class="domestic-kicker">Domestic cleaning near you</span>
                        <h1>{{ $serviceName }}</h1>
                        <p>{{ $heroSummary }}</p>
                        <ul class="domestic-list">
                            <li>Instant online booking confirmations</li>
                            <li>Locally based experts with premium supplies</li>
                            <li>No hidden fees or contracts</li>
                        </ul>
                        <div class="domestic-cta">
                            <a href="{{ route('book-services.index') }}" class="domestic-btn domestic-btn--primary">Book
                                domestic cleaning</a>
                            <a href="tel:+31685863638" class="domestic-btn domestic-btn--ghost">Call +31 685863638</a>
                        </div>
                        <div class="domestic-meta">
                            <span>{{ $priceRange }}</span>
                            <span>{{ $duration }}</span>
                        </div>
                    </div>
                    <div class="domestic-hero__card">
                        <h3>Why households choose KOA</h3>
                        <ul>
                            <li>Verified cleaners with ID and background checks</li>
                            <li>Optional eco cleaning upgrade</li>
                            <li>Secure payments and booking dashboard</li>
                            <li>Cleaner travel insured by KOA</li>
                        </ul>
                        <a href="{{ route('book-services.index') }}" class="domestic-btn domestic-btn--secondary">Get my
                            free quote</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="domestic-steps">
            <div class="domestic-container">
                <h2>Book professional cleaners in three steps</h2>
                <div class="domestic-grid domestic-grid--three">
                    @foreach($steps as $index => $step)
                        <div class="domestic-card">
                            <span class="domestic-step-number">{{ $index + 1 }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="domestic-plans">
            <div class="domestic-container">
                <div class="domestic-plans__header">
                    <div>
                        <h2>Choose the domestic cleaning plan that fits</h2>
                        <p>Every visit includes a satisfaction guarantee and flexible rebooking options.</p>
                    </div>
                    <a href="{{ route('book-services.index') }}" class="domestic-btn domestic-btn--link">Compare plans</a>
                </div>
                <div class="domestic-grid domestic-grid--three">
                    @foreach($plans as $plan)
                        <div class="domestic-card domestic-card--plan">
                            <span class="domestic-badge">{{ $plan['badge'] }}</span>
                            <h3>{{ $plan['title'] }}</h3>
                            <p>{{ $plan['description'] }}</p>
                            <strong>{{ $plan['price'] }}</strong>
                            <a href="{{ $plan['cta'] }}" class="domestic-btn domestic-btn--primary">Book this plan</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="domestic-includes">
            <div class="domestic-container">
                <div class="domestic-includes__grid">
                    <div>
                        <h2>What&apos;s included in every domestic clean</h2>
                        <ul class="domestic-list domestic-list--checks">
                            @foreach($serviceIncludes as $include)
                                <li>{{ $include }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('book-services.index') }}" class="domestic-btn domestic-btn--secondary">Add to my
                            booking</a>
                    </div>
                    <div>
                        <h3>Upgrades and extras</h3>
                        <ul class="domestic-list domestic-list--bullets">
                            @foreach($addons as $addon)
                                <li>{{ $addon }}</li>
                            @endforeach
                        </ul>
                        <p class="domestic-note">Select extras during checkout or chat with our support team to customise
                            your visit.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="domestic-benefits">
            <div class="domestic-container">
                <h2>Benefits of booking KOA domestic cleaners</h2>
                <div class="domestic-grid domestic-grid--four">
                    @foreach($benefits as $benefit)
                        <div class="domestic-card domestic-card--benefit">
                            <h3>{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="services-carousel py-10 bg-gray-50">
            <div class="container mx-auto">
                <h2 class="text-2xl font-semibold mb-6">Our Services</h2>

                <!-- Carousel Wrapper -->
                <div class="d-flex " style="flex-row">
                    @foreach($services as $service)
                        <div class="service-card flex-shrink-0 w-60 p-4 bg-white rounded-2xl shadow hover:shadow-lg transition">
                            <img src="{{ $service->image ?? '/placeholder.jpg' }}" alt="{{ $service->name }}"
                                class="w-full h-40 object-cover rounded-xl mb-4">
                            <h3 class="text-lg font-medium">{{ $service->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($service->description, 60) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="domestic-near-me">
            <div class="domestic-container">
                <div class="domestic-near-me__header">
                    <div>
                        <h2>Domestic cleaners near me </h2>
                        {{-- <p>Find KOA domestic cleaners across major UK towns, cities, and commuter belts.</p> --}}
                    </div>
                </div>
                <div class="domestic-near-me__grid">
                    <div>
                        <div class="domestic-near-me__lists">
                            @php
                                $freelancerCities = collect($freelancerCities);
                                $cityFreelancers = isset($cityFreelancers) ? collect($cityFreelancers) : collect();
                                $locationProfiles = collect($ukLocationProfiles);
                                $activeCityName = $selectedCity ?? ($freelancerCities->first() ?: null);
                                $activeCitySlug = $activeCityName ? Str::slug($activeCityName) : null;
                            @endphp

                            <div class="domestic-near-me__group">
                                <h3>KOA pros cover these towns and nearby neighbourhoods:</h3>
                                <div class="domestic-near-me__pills" data-location-pill-group>
                                    @foreach($freelancerCities as $city)
                                        @php $citySlug = Str::slug($city); @endphp
                                        <a href="{{ route('domestic-cleaning.places.show', $citySlug) }}" class="domestic-pill{{ $activeCitySlug === $citySlug ? ' is-active' : '' }}" data-location-select="{{ $citySlug }}">
                                            {{ $city }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                        <div>
                            <a href="{{ route('quote.index') }}"
                                class="domestic-btn domestic-btn--secondary domestic-near-me__cta">
                                Share my address
                            </a>
                        </div>
                    </div>
                    <div class="domestic-near-me__detail" data-location-detail>
                        @if($activeCityName)
                            @php $activeProfile = $locationProfiles->firstWhere('key', $activeCitySlug); @endphp
                            @if($activeProfile)
                                <article class="domestic-near-me__card is-active" data-location-card="{{ $activeProfile['key'] }}">
                                    <h3>{{ $activeProfile['name'] }}</h3>
                                    <p>{{ $activeProfile['description'] }}</p>
                                    <ul>
                                        @foreach($activeProfile['highlights'] as $highlight)
                                            <li>{{ $highlight }}</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('book-services.index') }}" class="domestic-btn domestic-btn--primary">Book
                                        cleaners in {{ $activeProfile['name'] }}</a>
                                </article>
                            @endif

                            <div class="domestic-near-me__freelancers">
                                <h3>Freelancers in {{ $activeCityName }}</h3>
                                @if($cityFreelancers->isEmpty())
                                    <p class="domestic-near-me__empty">We are onboarding local cleaners in {{ $activeCityName }}. Share your address to get matched.</p>
                                @else
                                    <div class="domestic-near-me__freelancer-grid">
                                        @foreach($cityFreelancers as $freelancer)
                                            @php
                                                $freelancerName = trim(($freelancer->first_name ? $freelancer->first_name.' ' : '').($freelancer->last_name ?? ''));
                                                if (! $freelancerName) {
                                                    $freelancerName = $freelancer->name ?: 'KOA Cleaner';
                                                }
                                            @endphp
                                            <div class="domestic-freelancer-card">
                                                <div class="domestic-freelancer-card__header">
                                                    <h4>{{ $freelancerName }}</h4>
                                                    @if($freelancer->profile_verification_status === 'verified')
                                                        <span class="domestic-badge domestic-badge--status">Verified</span>
                                                    @endif
                                                </div>
                                                <p class="domestic-freelancer-card__meta">{{ $freelancer->city }}</p>
                                                @if($freelancer->work_experience)
                                                    <p class="domestic-freelancer-card__text">{{ Str::limit($freelancer->work_experience, 120) }}</p>
                                                @endif
                                                <a href="{{ route('book-services.index') }}" class="domestic-btn domestic-btn--secondary">Book {{ $freelancerName }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="domestic-features">
            <div class="domestic-container">
                <div class="domestic-features__grid">
                    <div>
                        <h2>Why families trust KOA</h2>
                        <ul class="domestic-list domestic-list--checks">
                            @foreach($serviceFeatures as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="domestic-feature-card">
                        <h3>Need help fast?</h3>
                        <p>Chat with our concierge team for same-day availability or custom cleaning packages.</p>
                        <a href="mailto:hello@koa-services.com" class="domestic-btn domestic-btn--ghost">Email
                            hello@koa-services.com</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="domestic-reviews">
            <div class="domestic-container">
                <div class="domestic-reviews__header">
                    <div>
                        <h2>Loved by busy households</h2>
                        <p>Real feedback from KOA domestic cleaning clients across the Netherlands.</p>
                    </div>
                    <span class="domestic-rating">Rated 4.9/5 average</span>
                </div>
                <div class="domestic-grid domestic-grid--three">
                    @foreach($reviews as $review)
                        <div class="domestic-card domestic-card--review">
                            <div class="domestic-stars">★★★★★</div>
                            <p>{{ $review['text'] }}</p>
                            <span class="domestic-reviewer">{{ $review['name'] }} &bull; {{ $review['location'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="domestic-faq">
            <div class="domestic-container">
                <h2>Domestic cleaning FAQs</h2>
                <div class="domestic-faq__grid">
                    @foreach($faqs as $faq)
                        <details>
                            <summary>{{ $faq['question'] }}</summary>
                            <p>{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        @if($relatedServices->count() > 0)
            <section class="domestic-related">
                <div class="domestic-container">
                    <h2>Explore other KOA services</h2>
                    <div class="domestic-grid domestic-grid--four">
                        @foreach($relatedServices as $related)
                            <a href="{{ route('services.show', $related->slug) }}" class="domestic-card domestic-card--related">
                                <h3>{{ $related->name }}</h3>
                                <p>{{ $related->short_description }}</p>
                                <span class="domestic-card__cta">View service</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </article>
@endsection

@push('styles')
    <style>
        .domestic-page {
            font-family: 'Inter', 'Poppins', sans-serif;
            color: #241b33;
            background: #ffffff;
            --domestic-primary-start: #ff7a45;
            --domestic-primary-end: #ff3f76;
            --domestic-accent: #ffc27d;
            --domestic-deep: #2d1f3f;
            --domestic-muted: rgba(36, 27, 51, 0.68);
            --domestic-border: rgba(36, 27, 51, 0.16);
            --domestic-soft: #fff6ef;
        }

        .domestic-container {
            width: min(1200px, 92vw);
            margin: 0 auto;
        }

        .domestic-hero {
            background: linear-gradient(140deg, var(--domestic-soft) 0%, #ffffff 60%);
            padding: 80px 0;
        }

        .domestic-hero__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            align-items: center;
        }

        .domestic-hero__content h1 {
            font-size: clamp(2.4rem, 3.6vw, 3.4rem);
            margin-bottom: 12px;
            color: #10132a;
        }

        .domestic-hero__content p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .domestic-hero__card {
            background: var(--domestic-deep);
            color: #ffffff;
            padding: 32px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            box-shadow: 0 22px 40px rgba(36, 27, 51, 0.18);
        }

        .domestic-hero__card ul {
            padding: 0;
            margin: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .domestic-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--domestic-primary-end);
            background: rgba(255, 63, 129, 0.12);
            padding: 6px 12px;
            border-radius: 999px;
            margin-bottom: 18px;
        }

        .domestic-list {
            list-style: none;
            padding: 0;
            margin: 0 0 24px 0;
            display: grid;
            gap: 10px;
        }

        .domestic-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.98rem;
        }

        .domestic-list--checks li::before {
            content: '✔';
            color: var(--domestic-primary-start);
            font-weight: 700;
        }

        .domestic-list--bullets li::before {
            content: '•';
            color: var(--domestic-primary-end);
            font-size: 1.3rem;
        }

        .domestic-cta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
        }

        .domestic-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 26px;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .domestic-btn--primary {
            background: linear-gradient(135deg, var(--domestic-primary-start) 0%, var(--domestic-primary-end) 100%);
            color: #ffffff;
            box-shadow: 0 14px 30px rgba(255, 63, 129, 0.28);
        }

        .domestic-btn--primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(255, 122, 69, 0.32);
        }

        .domestic-btn--secondary {
            background: #ffffff;
            color: var(--domestic-deep);
            border: 2px solid var(--domestic-primary-start);
        }

        .domestic-btn--secondary:hover {
            transform: translateY(-2px);
        }

        .domestic-btn--ghost {
            border: 2px solid var(--domestic-border);
            color: var(--domestic-deep);
            background: transparent;
        }

        .domestic-btn--ghost:hover {
            transform: translateY(-2px);
            border-color: var(--domestic-primary-end);
            color: var(--domestic-primary-end);
        }

        .domestic-btn--link {
            color: var(--domestic-primary-end);
            font-weight: 600;
        }

        .domestic-meta {
            display: flex;
            gap: 24px;
            font-size: 0.95rem;
            color: rgba(16, 19, 42, 0.7);
        }

        .domestic-steps,
        .domestic-plans,
        .domestic-includes,
        .domestic-benefits,
        .domestic-coverage,
        .domestic-features,
        .domestic-reviews,
        .domestic-faq,
        .domestic-related,
        .domestic-final-cta {
            padding: 80px 0;
        }

        .domestic-steps h2,
        .domestic-plans h2,
        .domestic-includes h2,
        .domestic-benefits h2,
        .domestic-features h2,
        .domestic-reviews h2,
        .domestic-faq h2,
        .domestic-related h2,
        .domestic-final-cta h2 {
            font-size: clamp(2rem, 3vw, 2.6rem);
            margin-bottom: 20px;
            color: #10132a;
        }

        .domestic-grid {
            display: grid;
            gap: 24px;
        }

        .domestic-grid--three {
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .domestic-grid--four {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .domestic-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 14px 28px rgba(16, 19, 42, 0.08);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .domestic-card--plan {
            border: 1px solid rgba(31, 143, 77, 0.18);
        }

        .domestic-card--benefit {
            background: linear-gradient(145deg, rgba(31, 143, 77, 0.08), rgba(84, 192, 108, 0.12));
        }

        .domestic-coverage {
            padding: 80px 0;
        }

        .domestic-coverage__header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 36px;
        }

        .domestic-coverage__header p {
            max-width: 520px;
            color: var(--domestic-muted);
        }

        .domestic-near-me__grid {
            display: grid;
            gap: 48px;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            align-items: start;
        }

        .domestic-near-me__lists {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .domestic-near-me__group h3 {
            font-size: 1rem;
            color: rgba(16, 19, 42, 0.78);
            margin-bottom: 14px;
        }

        .domestic-near-me__pills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .domestic-pill {
            border: 1px solid rgba(16, 19, 42, 0.16);
            background: #ffffff;
            border-radius: 999px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #10132a;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .domestic-pill:hover {
            border-color: #1f8f4d;
            color: #1f8f4d;
        }

        .domestic-pill.is-active {
            background: linear-gradient(135deg, #1f8f4d 0%, #54c06c 100%);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 14px 28px rgba(31, 143, 77, 0.25);
        }

        .domestic-near-me__cta {
            margin-top: 4px;
        }

        .domestic-near-me__detail {
            position: relative;
        }

        .domestic-near-me__card {
            display: none;
            background: linear-gradient(140deg, #10132a 0%, #1e2748 100%);
            color: #ffffff;
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 24px 48px rgba(16, 19, 42, 0.24);
            gap: 18px;
        }

        .domestic-near-me__card.is-active {
            display: flex;
            flex-direction: column;
        }

        .domestic-near-me__card p {
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.6;
        }

        .domestic-near-me__card ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 12px;
        }

        .domestic-near-me__card ul li {
            position: relative;
            padding-left: 20px;
        }

        .domestic-near-me__card ul li::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 0;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #54c06c;
        }

        .domestic-near-me__card .domestic-btn {
            align-self: flex-start;
        }

        .domestic-step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #4b5dff;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .domestic-badge {
            align-self: flex-start;
            background: rgba(255, 63, 129, 0.12);
            color: #ff3f81;
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .domestic-includes {
            background: #f7faf7;
        }

        .domestic-includes__grid {
            display: grid;
            gap: 40px;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .domestic-note {
            margin-top: 18px;
            font-size: 0.9rem;
            color: rgba(16, 19, 42, 0.65);
        }

        .domestic-features__grid {
            display: grid;
            gap: 40px;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            align-items: stretch;
        }

        .domestic-feature-card {
            background: linear-gradient(140deg, #10132a 0%, #1e2748 100%);
            color: #ffffff;
            border-radius: 20px;
            padding: 32px;
            display: flex;
            flex-direction: column;
            gap: 18px;
            box-shadow: 0 18px 36px rgba(16, 19, 42, 0.2);
        }

        .domestic-reviews {
            background: #f6f9ff;
        }

        .domestic-reviews__header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 32px;
        }

        .domestic-rating {
            background: rgba(75, 93, 255, 0.1);
            color: #4b5dff;
            padding: 8px 18px;
            border-radius: 999px;
            font-weight: 600;
        }

        .domestic-card--review p {
            font-size: 0.98rem;
            line-height: 1.6;
            color: rgba(16, 19, 42, 0.78);
        }

        .domestic-stars {
            color: #f7b500;
            letter-spacing: 2px;
            font-size: 1rem;
        }

        .domestic-reviewer {
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(16, 19, 42, 0.6);
        }

        .domestic-faq__grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .domestic-faq details {
            border: 1px solid rgba(16, 19, 42, 0.12);
            border-radius: 16px;
            padding: 18px 22px;
            background: #ffffff;
            box-shadow: 0 10px 24px rgba(16, 19, 42, 0.05);
        }

        .domestic-faq summary {
            font-weight: 600;
            cursor: pointer;
            list-style: none;
            outline: none;
        }

        .domestic-faq summary::-webkit-details-marker {
            display: none;
        }

        .domestic-faq details[open] {
            border-color: #1f8f4d;
        }

        .domestic-faq details p {
            margin-top: 12px;
            color: rgba(16, 19, 42, 0.72);
            line-height: 1.6;
        }

        .domestic-card--related {
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(16, 19, 42, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .domestic-card--related:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 34px rgba(16, 19, 42, 0.12);
        }

        .domestic-card__cta {
            font-weight: 600;
            color: #1f8f4d;
        }

        .domestic-final-cta {
            background: linear-gradient(135deg, var(--domestic-primary-start) 0%, var(--domestic-primary-end) 100%);
            color: #ffffff;
            text-align: center;
            border-radius: 32px;
            width: min(1100px, 94vw);
            margin: 0 auto 120px auto;
            padding: 72px 24px;
            box-shadow: 0 24px 48px rgba(255, 63, 129, 0.32);
        }

        .domestic-final-cta p {
            font-size: 1.05rem;
            margin-bottom: 28px;
        }

        @media (max-width: 768px) {
            .domestic-hero {
                padding: 64px 0;
            }

            .domestic-hero__card {
                padding: 24px;
            }

            .domestic-meta {
                flex-direction: column;
                gap: 10px;
            }

            .domestic-near-me__grid {
                grid-template-columns: 1fr;
            }

            .domestic-near-me__cta {
                align-self: stretch;
            }

            .domestic-near-me__card {
                padding: 28px;
            }

            .domestic-final-cta {
                margin-bottom: 80px;
                border-radius: 24px;
                padding: 48px 20px;
            }
        }

        @media (max-width: 520px) {
            .domestic-cta {
                flex-direction: column;
                align-items: stretch;
            }

            .domestic-btn {
                width: 100%;
            }

            .domestic-near-me__pills {
                flex-direction: column;
            }

            .domestic-pill {
                width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pills = document.querySelectorAll('[data-location-select]');
            const cards = document.querySelectorAll('[data-location-card]');
            if (!pills.length || !cards.length) {
                return;
            }
            pills.forEach(function (pill) {
                pill.addEventListener('click', function () {
                    const key = pill.getAttribute('data-location-select');
                    pills.forEach(function (item) {
                        item.classList.toggle('is-active', item === pill);
                    });
                    cards.forEach(function (card) {
                        card.classList.toggle('is-active', card.getAttribute('data-location-card') === key);
                    });
                });
            });
        });
    </script>
@endpush