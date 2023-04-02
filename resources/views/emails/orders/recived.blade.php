<x-mail::message>
# You've just purchased our swag, {{ $order['billing_name'] }}

## We've attached the invoice to this email.<br>

<x-mail::button :url="route('dashboard')">
View Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
