@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="">
            <p class="my-2 text-red-600">{{ session('success') }}</p>
            <p class="my-2 text-red-600">{{ session('error') }}</p>
           
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    Dashboard
                </div>

                <div class="w-full p-6">
                    <p class="text-gray-700">
                        You are logged in!
                    </p>
                </div>
            </div>

            @forelse($permissions as $permission)
                <p class="py-3 text-lg">{{ $permission->name }}</p>
            @empty

            @endforelse
        </div>
    </div>
@endsection
