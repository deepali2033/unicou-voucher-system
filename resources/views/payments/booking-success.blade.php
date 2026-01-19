@extends('layouts.app')

@section('title', 'Booking Confirmed')

@push('styles')
    <style>
        .booking-success-container {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .booking-success-card {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 3rem 2rem;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2.5rem;
        }

        .success-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .success-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .booking-reference {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin: 1.5rem 0;
            font-size: 1.3rem;
            font-weight: bold;
        }

        .booking-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }

        .booking-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .booking-detail-row:last-child {
            border-bottom: none;
        }

        .booking-detail-label {
            color: #6c757d;
            font-weight: 600;
        }

        .booking-detail-value {
            color: #2c3e50;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            background: transparent;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .booking-success-card {
                padding: 2rem 1rem;
            }

            .success-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary,
            .btn-outline-secondary {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="booking-success-container">
        <div class="booking-success-card">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <h1 class="success-title">Booking Confirmed!</h1>
            <p class="success-subtitle">
                Thank you for booking with us! Your payment has been processed successfully.
                Your booking has been confirmed and our team will contact you shortly.
            </p>

            <div class="booking-reference">
                Reference: BK-{{ $booking->id }}
            </div>

            <div class="booking-details">
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Service:</span>
                    <span class="booking-detail-value">{{ $booking->service_name }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Booking Date:</span>
                    <span
                        class="booking-detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Booking Time:</span>
                    <span class="booking-detail-value">{{ $booking->booking_time }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Address:</span>
                    <span class="booking-detail-value">
                        {{ $booking->street_address }}, {{ $booking->city }}, {{ $booking->state }} {{ $booking->zip_code }}
                    </span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Bedrooms:</span>
                    <span class="booking-detail-value">{{ $booking->bedrooms }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Bathrooms:</span>
                    <span class="booking-detail-value">{{ $booking->bathrooms }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Amount Paid:</span>
                    <span class="booking-detail-value">€{{ number_format($booking->price, 2) }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Name:</span>
                    <span class="booking-detail-value">{{ $booking->customer_name }}</span>
                </div>
                <div class="booking-detail-row">
                    <span class="booking-detail-label">Email:</span>
                    <span class="booking-detail-value">{{ $booking->email }}</span>
                </div>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>What's Next?</strong> Our team will review your booking and contact you within 24 hours to confirm
                all details.
            </div>

            <div class="action-buttons">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>Back to Home
                </a>
                <a href="{{ route('book-services.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-plus me-2"></i>New Booking
                </a>
            </div>
        </div>
    </div>
@endsection