<x-mail::message>
 
{{ $messageBody }}

@if(!empty($url))
<x-mail::button :url="$url">
View assigned abstract
</x-mail::button>
@endif

</x-mail::message>