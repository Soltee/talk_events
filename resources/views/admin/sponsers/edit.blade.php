@extends('layouts.admin')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
@endsection

@section('content')
    <div class="px-3 md:px-6 pb-6 pt-4">

        <form method="POST" action="{{ route('sponser.update', $sponser->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex justify-between items-center  mb-6">

                <div class="flex items-center">
                    @include('partials.admin-breadcrumb', ['url' => '/admin/speakers', 'link' => true, 'pageName' => 'Speakers', 'routeName' => Route::currentRouteName()])
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-c-light-gray" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    <h4 class="text-sm md:text-md  hover:font-semibold font-light text-c-pink mr-2 font-semibold">Edit {{ $sponser->full_name }} </h4>
                </div>

                <button type="submit" class="px-6 py-3  rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white">
                        Save
                </button>
            
            </div>

            <div class="flex items-center mb-4">
            <p class="text-red-600 text-md ml-5"><span>NOTE :</span> Leave as it is if you don't want to update.</p>
            </div>

         
            <div class="flex justify-between flex-col md:flex-row">
                <div class="flex flex-col md:mr-4 w-full md:w-1/2">

                    <h4 class="text-md mb-3 ">1. General Info</h4>
                    <div class="flex flex-wrap mb-6">
                        <label for="full_name" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Full name') }}
                        </label>

                        <input id="full_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('full_name') border-red-500 @enderror " name="full_name" value="{{ old('full_name') ?? $sponser->full_name }}"  autofocus placeholder="">

                        @error('full_name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                   
                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Email') }}
                        </label>

                        <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror " name="email" value="{{ old('email')  ?? $sponser->email }}"  autofocus placeholder="">

                        @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="about" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('About') }}
                        </label>

                         <textarea id="about" type="about" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('about') border-red-500 -40 @enderror " name="about"   rows="10">
                            
                            {{ old('about') ?? $sponser->about }}
                        </textarea>

                        @error('about')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <h4 class="text-md mb-3 ">2. Company Info</h4>
                    <div class="flex flex-wrap mb-6">
                        <label for="company_name" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Name') }}
                        </label>

                        <input id="company_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('company_name') border-red-500 @enderror " name="company_name" value="{{ old('company_name') ?? $sponser->company_name }}"  autofocus placeholder="">

                        @error('company_name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <label for="company_link" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('company_link') }}
                        </label>

                        <input id="company_link" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('company_link') border-red-500 @enderror " name="company_link" value="{{ old('company_link') ?? $sponser->company_link }}"  autofocus placeholder="">

                        @error('company_link')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
                <div class="flex flex-col md:mr-4 w-full md:w-1/2">
                    <h4 class="text-md mb-3 ">3. Avatar </h4>
                    <div class="flex flex-wrap mb-6">

                        <input id="avatar" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('avatar') border-red-500 @enderror " name="avatar" value="{{ old('avatar') ?? $sponser->avatar }}"  autofocus placeholder="">

                        @error('avatar')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <img id="avatarImage" src="{{ asset($sponser->avatar) }}" class="mb-6 rounded object-cover h-40 object-center">
                    
                    <h4 class="text-md mb-3 ">4. Event </h4>
                    <div class="flex flex-wrap mb-6">
                        <div class="events_name" class="mb-3"></div>
                        @error('events')
                            <p class="text-red-500 text-xs italic my-4">
                                {{ $message }}
                            </p>
                        @enderror
                      
                        <div class="inline-block relative w-full">
                            <select 
                                id="slim-select" 
                                multiple 
                                name="events[]" class="block appearance-none w-full bg-white border-r-lg border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                                >
                                    <option data-placeholder="true"></option>
                                    @forelse($events as $event)
                                        <option selected value="{{ $event->id }}">{{ $event->title }}</option>
                                    @empty
                                    @endforelse
                                    @forelse($more_events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @empty
                                    @endforelse


                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('scripts')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>    
    <script>

        document.addEventListener("DOMContentLoaded", function(){
            let allEvents = document.getElementById('allEvents');
            var select =  new SlimSelect({
              select: '#slim-select',
                placeholder: 'Select Events'
            });

            console.log(select.selected());

            //Avatar Show On Choose
            
            let readImage = document.getElementById('avatarImage');

            var file = document.querySelector('input[type=file]');
            file.addEventListener('change', function(e){

                var reader = new FileReader(); // Creating reader instance from FileReader() API

                reader.addEventListener("load", function () { // Setting up base64 URL on image
                    readImage.classList.add('h-40');
                    readImage.src = reader.result;

                }, false);

                reader.readAsDataURL(e.target.files[0]);
                console.log(readImage);
            });  // File refrence

        });     
        
    </script>

@endpush