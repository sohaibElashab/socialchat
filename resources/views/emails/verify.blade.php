@component('mail::message')
# Verifcation email

This is your verification code.

{{$data}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
