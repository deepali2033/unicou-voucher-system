@extends('layouts.app')

@section('title', 'Browse Jobs - KOA Service')
@section('meta_description', 'Browse and apply to available job opportunities with KOA Service. Find full-time and part-time positions in cleaning and household services.')

@section('content')
<style>
/* Jobs Browse Page Specific Styles */
.jobs-browse-wrapper {
    padding: 60px 0;
    background-color: #f8f9fa;
}

.jobs-browse-header {
    text-align: center;
    margin-bottom: 50px;
}

.jobs-browse-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 10px;
}

.jobs-browse-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.jobs-grid-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.job-block-item {
    flex: 0 0 calc(50% - 15px);
    max-width: calc(50% - 15px);
    display: flex;
    flex-direction: column;
    background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.job-block-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.job-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 280px;
}

.job-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.job-block-item:hover .job-image-wrapper img {
    transform: scale(1.05);
}

.job-icon-overlay {
    position: absolute;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.job-block-item:hover .job-icon-overlay {
    transform: scale(1.1);
}

.job-icon-overlay svg {
    width: 32px;
    height: auto;
}

.job-content-section {
    padding: 30px 25px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.job-title-heading {
    margin: 0 0 15px 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.job-title-heading a {
    color: #1a1a1a;
    text-decoration: none;
    transition: color 0.3s ease;
}

.job-title-heading a:hover {
    color: #3CA200;
}

.job-action-button {
    margin-top: auto;
}

.job-learn-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    background-color: #3CA200;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: background-color 0.3s ease, gap 0.3s ease;
}

.job-learn-more-btn:hover {
    background-color: #2d7a00;
    color: white;
    gap: 12px;
}

.job-arrow-icon {
    display: inline-block;
    transition: transform 0.3s ease;
}

.job-learn-more-btn:hover .job-arrow-icon {
    transform: translateX(3px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .job-block-item {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .jobs-browse-header h2 {
        font-size: 2rem;
    }

    .job-image-wrapper {
        height: 220px;
    }

    .jobs-browse-wrapper {
        padding: 40px 0;
    }
}

@media (max-width: 480px) {
    .jobs-browse-header h2 {
        font-size: 1.75rem;
    }

    .job-content-section {
        padding: 20px 18px;
    }

    .job-title-heading {
        font-size: 1.25rem;
    }
}
</style>

<article id="post-21" class="full post-21 page type-page status-publish hentry">
    <div class="elementor elementor-3575 elementor-location-single post-21 page type-page status-publish hentry">

        <div class="jobs-browse-wrapper">
            <div class="jobs-browse-container">
                {{-- Heading --}}
                <div class="jobs-browse-header">
                    <h1>Jobs We Provide</h1>
                </div>

                {{-- Jobs Grid --}}
                <div class="jobs-grid-wrapper">

                    {{-- Full-Time Jobs --}}
                    <div class="job-block-item">
                        <a href="/jobs/full-time" class="job-image-wrapper">
                            <img src="{{ asset('images/service/job3.jpg') }}" alt="Full-Time Jobs">
                            <div class="job-icon-overlay">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="37" viewbox="0 0 32 37">
                                    <g fill="none" fill-rule="evenodd">
                                        <path d="M3.56 12.63c.43 7.7 0 24.3 0 24.3s19.38.07 24.71.07c.22-3.42-.37-16.05.17-24.3-7.54 0-18.47-.07-24.88-.07Z" fill="#FFF"></path>
                                        <path d="M4.13 36.58h2.54a30360.33 30360.33 0 0 0 19.5.06h1.76v-.06c.02-.4.03-.84.03-1.47v-.75c0-1.17-.02-2.85-.05-5.49-.04-2.8-.06-4.7-.06-6.57v-.7c0-3.32.07-6.1.2-8.45l.01-.08h-1.22l-9.33-.03h-1.94L6.22 13H3.94l.01.31c.1 2.17.15 5.02.16 8.41v1.15a595.34 595.34 0 0 1-.18 13.54v.17h.2Zm24.31-23.87c-.43 6.7-.13 16.31-.12 21.5v.63c0 .9-.01 1.64-.05 2.16h-2.04l-7.74-.02h-2.68L4.4 36.93H3.56v-.03c0-.46.17-7.1.19-13.8v-1.5c-.01-3.34-.06-6.59-.2-8.98h1.22c6.1.01 15.3.07 22.27.08h1.4Z" fill="#000" fill-rule="nonzero"></path>
                                        <path d="M4.94 13.99c.38 6.84 0 21.6 0 21.6s17.23.06 21.97.06c.2-3.04-.33-14.27.15-21.6-6.7 0-16.42-.06-22.12-.06Z" fill="#FFF"></path>
                                        <path d="M26.15 14.23h-.64c-2.14 0-4.67 0-8.17-.02h-1.72l-8.5-.04h-2l.02.14c.1 2.17.15 5.16.15 8.78a529.05 529.05 0 0 1-.13 10.93l-.02.68-.01.6v.11H6.83l.87.01a26986.42 26986.42 0 0 0 17.19.04h1.83l.01-.05c.05-.98.05-2.26-.01-6.64v-.35c-.04-2.81-.06-4.58-.06-6.47 0-2.93.06-5.4.18-7.47l.02-.25h-.72Zm.73-.18h.18c-.15 2.36-.2 5.12-.2 7.88v1.83c.02 5.18.17 10.04.05 11.89h-1.74l-7.52-.02H15.8l-10.13-.04h-.73v-.02c.01-.43.14-5.76.16-11.38v-2.16c0-3-.04-5.9-.16-8.04h1.15c5.4 0 13.48.06 19.64.06h1.15Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#FFF" d="M12.44 27.07h7.11V37h-7.11z"></path>
                                        <path d="M19.56 27.07V37h-7.12v-9.93h7.12Zm-.37.36H12.8v9.2h6.4v-9.2Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#FFF" d="M7.44 17.07h6v5h-6z"></path>
                                        <path d="M13.44 17.07v5h-6v-5h6Zm-.18.18H7.62v4.64h5.64v-4.64Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#FFF" d="M18.44 17.07h6v5h-6z"></path>
                                        <path d="M24.44 17.07v5h-6v-5h6Zm-.18.18h-5.64v4.64h5.64v-4.64ZM17.03 35c-.02 0-.03-.08-.03-.16l.03-4.69.01-.1c0-.04.02-.05.03-.05.02 0 .03.08.03.16l-.03 4.68-.01.11c0 .03-.02.05-.03.05ZM15.04 36l-.03-.05a.56.56 0 0 1-.01-.13l.01-2.65c0-.04 0-.09.02-.12 0-.03.02-.05.03-.05l.03.05.01.13-.01 2.65c0 .1-.02.17-.05.17Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#3CA200" d="m16 0 16 15H0z"></path>
                                        <path d="m16 0 16 15H0L16 0Zm0 .5L.91 14.63H31.1L16 .49Z" fill="#000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                            </div>
                        </a>
                        <div class="job-content-section">
                            <h4 class="job-title-heading"><a href="/jobs/full-time">Full-Time Jobs</a></h4>
                            <div class="job-action-button">
                                <a href="/jobs/full-time" class="job-learn-more-btn">
                                    <span class="job-arrow-icon">→</span>
                                    <span>Learn more</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Part-Time Jobs --}}
                    <div class="job-block-item">
                        <a href="/jobs/part-time" class="job-image-wrapper">
                            <img src="{{ asset('images/service/job.jpg') }}" alt="Part-Time Jobs">
                            <div class="job-icon-overlay">
                                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="29" viewbox="0 0 46 29">
                                    <g fill="none" fill-rule="evenodd">
                                        <path d="M4.1 17h23v3H4.08v-3Z" fill="#FFF"></path>
                                        <path d="M27.1 17v3h-23v-3h23Zm-.24.23H4.32v2.54h22.54v-2.54Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#FFF" d="M26.1 6h15v18h-15z"></path>
                                        <path d="M41.1 6v18h-15V6h15Zm-.24.23H26.32v17.54h14.54V6.23Z" fill="#000" fill-rule="nonzero"></path>
                                        <g fill-rule="nonzero">
                                            <path d="M31.8 9.21c-.45.14-.66.79-.49 1.23.19.36.62.51 1 .35a.93.93 0 0 0 .62-.84.85.85 0 0 0-1.13-.74Z" fill="#FFF"></path>
                                            <path d="M31.99 11c-.15 0-.3-.03-.44-.1a.74.74 0 0 1-.4-.4c-.1-.33-.07-.68.08-.97.1-.23.3-.4.52-.47a1 1 0 0 1 .92.13c.24.17.4.45.42.75-.01.46-.3.85-.74 1-.11.04-.24.06-.36.06Zm.1-1.6a.66.66 0 0 0-.2.04.5.5 0 0 0-.3.27c-.1.2-.12.42-.06.63.04.1.11.17.2.2.16.07.33.08.5.02a.68.68 0 0 0 .46-.6.62.62 0 0 0-.26-.45.57.57 0 0 0-.33-.11Z" fill="#000"></path>
                                        </g>
                                        <g fill-rule="nonzero">
                                            <path d="M32.8 17.21c-.45.14-.66.79-.49 1.23.19.36.62.51 1 .35a.93.93 0 0 0 .62-.84.85.85 0 0 0-1.13-.74Z" fill="#FFF"></path>
                                            <path d="M31.99 19c-.15 0-.3-.03-.44-.1a.74.74 0 0 1-.4-.4c-.1-.33-.07-.68.08-.97.1-.23.3-.4.52-.47a1 1 0 0 1 .92.13c.24.17.4.45.42.75-.01.46-.3.85-.74 1-.11.04-.24.06-.36.06Zm.1-1.6a.66.66 0 0 0-.2.04.5.5 0 0 0-.3.27c-.1.2-.12.42-.06.63.04.1.11.17.2.2.16.07.33.08.5.02a.68.68 0 0 0 .46-.6.62.62 0 0 0-.26-.45.57.57 0 0 0-.33-.11Z" fill="#000"></path>
                                        </g>
                                        <path d="M26.5 13.5c2.65.33 4.81.5 6.5.5 1.69 0 4.22-.17 7.6-.5" fill="#FFF"></path>
                                        <path d="m40.58 13.39.03.22c-3.38.34-5.92.5-7.61.5-1.7 0-3.86-.16-6.51-.5l.02-.22c2.65.33 4.8.5 6.49.5 1.68 0 4.21-.17 7.58-.5Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#FFF" d="M3.1 5h3v24h-3z"></path>
                                        <path d="M6.1 5v24h-3V5h3Zm-.24.23H3.32v23.54h2.54V5.23Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#FFF" d="M39.1 5h3v24h-3z"></path>
                                        <path d="M42.1 5v24h-3V5h3Zm-.24.23h-2.54v23.54h2.54V5.23Z" fill="#000" fill-rule="nonzero"></path>
                                        <path fill="#3CA200" d="M.1 0h45l-1 7h-43z"></path>
                                        <path d="m45.1 0-1 7h-43l-1-7h45Zm-.27.23H.36l.93 6.54h42.6l.94-6.54Z" fill="#000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                            </div>
                        </a>
                        <div class="job-content-section">
                            <h4 class="job-title-heading"><a href="/jobs/part-time">Part-Time Jobs</a></h4>
                            <div class="job-action-button">
                                <a href="/jobs/part-time" class="job-learn-more-btn">
                                    <span class="job-arrow-icon">→</span>
                                    <span>Learn more</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</article>
@endsection
