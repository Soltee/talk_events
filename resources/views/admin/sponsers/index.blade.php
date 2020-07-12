@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="">
            <p class="my-2 text-red-600">{{ session('success') }}</p>
            <p class="my-2 text-red-600">{{ session('error') }}</p>
           
            Sponsers
        </div>
    </div>
@endsection
