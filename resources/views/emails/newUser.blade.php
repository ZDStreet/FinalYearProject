<x-mail::message>
 
{{ $messageBody }}<br>
{{ $email }}<br>
{{ $password }}<br>
@if(!empty($url))
Please reset your password at the link.
<x-mail::button :url="$url">
Password Reset
</x-mail::button>
@endif

</x-mail::message>