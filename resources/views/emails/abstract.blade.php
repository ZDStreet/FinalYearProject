<x-mail::message>
 
{{ $messageBody }}

@if(!empty($url))
<x-mail::button :url="$url">
View your abstract
</x-mail::button>
@endif

</x-mail::message>