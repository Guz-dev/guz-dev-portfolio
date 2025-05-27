@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="flex flex-col items-center justify-center w-full dark:text-white">
        <h1 class="text-3xl font-bold text-center mb-4"> {{ __('content.home.name') }} </h1>
        <p class="text-lg text-center mb-4"> {{ __('content.home.description') }}</p>
    </div>
@endsection