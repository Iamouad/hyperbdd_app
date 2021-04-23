@component('mail::message')
# Hello {{ $username }},

Your account has been finally activated.<br> 
We can't wait to see you, feel free to join us following the link below. 

@component('mail::button', ['url' => route('login')])
Sign-In
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
