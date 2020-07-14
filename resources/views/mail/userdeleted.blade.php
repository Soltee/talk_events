@component('mail::message')

<p>Name      : {{ $first }} {{ $last }}</p> 
<p>Email     : {{ $email }} </p>

@component('mail::button', ['url' => env('APP_URL')])
Events
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
