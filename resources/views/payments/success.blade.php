@extends('layouts.app')

@section('title', 'Payment Successful')

@push('styles')
<style>
    .payment-success-container {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-success-card {
        max-width: 600px;
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

    .payment-details {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin: 2rem 0;
        text-align: left;
    }

    .payment-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .payment-detail-row:last-child {
        border-bottom: none;
        font-weight: bold;
        font-size: 1.1rem;
        margin-top: 0.5rem;
        padding-top: 1rem;
    }

    .payment-detail-label {
        color: #6c757d;
        font-weight: 500;
    }

    .payment-detail-value {
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
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .payment-success-card {
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
<br/>
<div class="payment-success-container">
    <div class="payment-success-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>

        <h1 class="success-title">Payment Successful!</h1>
        <p class="success-subtitle">
            Thank you for your payment. Your transaction has been completed successfully.
            We'll be in touch soon to discuss your {{ $plan_name }} service.
        </p>

        <div class="payment-details">
            <div class="payment-detail-row">
                <span class="payment-detail-label">Plan:</span>
                <span class="payment-detail-value">{{ $plan_name }}</span>
            </div>
            <div class="payment-detail-row">
                <span class="payment-detail-label">Amount Paid:</span>
                <span class="payment-detail-value">£{{ number_format($payment->amount, 2) }}</span>
            </div>
            <div class="payment-detail-row">
                <span class="payment-detail-label">Payment Date:</span>
                <span class="payment-detail-value">{{ $payment->created_at->format('F j, Y \a\t g:i A') }}</span>
            </div>
            @if($payment->customer_email)
            <div class="payment-detail-row">
                <span class="payment-detail-label">Email:</span>
                <span class="payment-detail-value">{{ $payment->customer_email }}</span>
            </div>
            @endif
        </div>

        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i>
            <strong>What's Next?</strong> Our team will contact you within 24 hours to schedule your service and discuss any specific requirements.
        </div>

        <div class="action-buttons">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>Back to Home
            </a>
            <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-phone me-2"></i>Contact Us
            </a>
        </div>
    </div>
</div>
@endsection
