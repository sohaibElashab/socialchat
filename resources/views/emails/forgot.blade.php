@component('mail::message')
# Password reset

The following link will enable you to set a new password for your account.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/?#/resetPassword?token='.$data])
Reset password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
