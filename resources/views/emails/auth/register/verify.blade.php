@component('mail::message')
# Email Confirmation

Please refer to the following link:

@component('mail::button', ['url' => route('verification.verify', ['token' => $user->verify_token])])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
