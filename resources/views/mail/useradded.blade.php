@component('mail::message')

<p>Email     : {{ $email    }}</p>
<p>Password  : {{ $pass }}</p>

<p class="mt-4">Role  : {{ $role }}</p>
@forelse($permissions as $p)
	<p class="ml-3">{{ $p }}</p>
@empty
@endforelse
@component('mail::button', ['url' =>  env('APP_URL')])
Events
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
