@component('mail::message')

<p class="mt-4">Events</p>
@forelse($events as $event)
	<p class="ml-3">{{ $event }}</p>
@empty
@endforelse

@component('mail::button', ['url' =>  env('APP_URL')])
Events
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
