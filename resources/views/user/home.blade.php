@extends('layouts.app')
@section('title' , 'Dashboard')
@section('head')
@endsection

@section('content')
    <div class="">
        <div class="flex flex-col w-full">
            <!--Livewire User Component-->
            <livewire:user.auth.dashboard />
            
        </div>
    </div>
@endsection
