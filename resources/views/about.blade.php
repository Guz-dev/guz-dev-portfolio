@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="flex flex-col items-center justify-center w-full dark:text-white">
        <h1 class="text-3xl font-bold text-center mb-4">
            {{ __('content.about.title') }}
        </h1>

        <p class="text-lg text-center mb-4 max-w-2xl">
            {{ __('content.about.intro') }}
        </p>

        <p class="text-base text-center mb-6 text-gray-600 dark:text-gray-300">
            {{ __('content.about.location_age', ['age' => \Carbon\Carbon::parse('1999-11-09')->age]) }}
        </p>

        <div class="grid gap-6 w-full max-w-3xl">
            <div class="p-4 border rounded-lg shadow dark:border-gray-700 dark:bg-gray-900">
                <h2 class="text-xl font-semibold mb-2">{{ __('content.about.education_title') }}</h2>
                <p>{{ __('content.about.education_description') }}</p>
            </div>

            <div class="p-4 border rounded-lg shadow dark:border-gray-700 dark:bg-gray-900">
                <h2 class="text-xl font-semibold mb-2">{{ __('content.about.skills_title') }}</h2>
                <p>{{ __('content.about.skills_description') }}</p>
            </div>

            <div class="p-4 border rounded-lg shadow dark:border-gray-700 dark:bg-gray-900">
                <h2 class="text-xl font-semibold mb-2">{{ __('content.about.learning_title') }}</h2>
                <p>{{ __('content.about.learning_description') }}</p>
            </div>

            <div class="p-4 border rounded-lg shadow dark:border-gray-700 dark:bg-gray-900">
                <h2 class="text-xl font-semibold mb-2">{{ __('content.about.values_title') }}</h2>
                <p>{{ __('content.about.values_description') }}</p>
            </div>
        </div>

    </div>
@endsection