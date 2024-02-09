<x-mail::message>
# Kode OTP

Jangan bagikan kode OTP ini kepada siapa pun.

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}
<x-mail::panel>
Kode OTP adalah {{ $otp }}.
</x-mail::panel>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
