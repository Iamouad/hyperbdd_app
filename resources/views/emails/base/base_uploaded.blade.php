@component('mail::message')
# Hello {{ $username }},

Your Database has been finally uploaded.<br> 
We invite you to to check it following the link below. 

@component('mail::button', ['url' => route('baseIndex', ['id' => $idBase])])
Check 
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
