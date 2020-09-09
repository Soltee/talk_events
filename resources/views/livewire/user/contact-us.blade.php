<div class="mt-8">

	<form wire:submit.prevent="store" class="w-full mt-3" method="POST" >
            @csrf

            
            @if (session()->has('error'))

                <div class="px-2 py-3 mb-6 rounded text-red-500 bg-red-100">

                    {{ session('error') }}

                </div>

            @endif

            @if (session()->has('success'))

                <div class="px-2 py-3 mb-6 rounded text-green-500 bg-green-100">

                    {{ session('success') }}

                </div>

            @endif

            <div class="flex flex-wrap mb-6">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Name') }}:
                </label>

                <input id="name" type="text" class="form-input w-full" wire:model="name" value="{{ old('name') }}"  autocomplete="Name" >

                @error('name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-wrap mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('E-Mail') }}:
                </label>

                <input id="email" type="email" class="form-input w-full" wire:model="email" value="{{ old('email') }}"  autocomplete="email" >

                @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div class="flex flex-wrap mb-6">
                <label for="topic" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Topic') }}:
                </label>

                <input id="topic" type="topic" class="form-input w-full " wire:model="topic" >

                @error('topic')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col mb-6">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">
                    {{ __('Message') }}:
                </label>

                <textarea rows="5" wire:model="message" id="message" class="form-input w-full">
                	
                </textarea>

                @error('message')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center">
                <button type="submit" class="bg-blue-500 w-full  hover:bg-blue-700 text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline flex justify-around items-center">

                    <div wire:loading class="spinner">
                      <div class="bounce1"></div>
                      <div class="bounce2"></div>
                      <div class="bounce3"></div>
                    </div>
                    <span wire:loading.remove class="font-semibold">{{ __('Send') }}</span>
                </button>

            </div>
        </form>

</div>
