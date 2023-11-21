<x-mail::message>
# Order Shipped
 
{{$user->name}} has purchased items and submiited an order.
 
<x-mail::button :url="$url">
View Order
</x-mail::button>
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>