@component('mail::message')
# Password Change

Below is an email OTP to change your password

# {{$otp}}
Thanks,<br>
{{ config('app.name') }}
@endcomponent