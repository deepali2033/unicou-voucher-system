@component('mail::message')

{{-- Logo --}}
@component('mail::panel')
<img src="{{ asset('images/company_logo.png') }}" alt="KOA Services Logo" style="max-width: 200px; height: auto;">
@endcomponent

# Verify Your Email Address

Hello {{ $user->name }},

Please click the button below to verify your email address.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Verify Email Address
@endcomponent

If you did not create an account, no further action is required.

Thanks,<br>
{{ config('app.name') }}

@endcomponent