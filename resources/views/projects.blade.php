@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white text-center">
            {{ __('content.projects.title') }}
        </h1>

        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6 text-center">
            {{ __('content.projects.description') }}
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            @foreach ($projects as $project)
                <a href="{{ route('projects.' . \Str::kebab($project->project_name)) }}" class="flex flex-col justify-between p-5 bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 ">
                    <container>
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-md mb-4 flex items-center justify-center text-gray-400 dark:text-gray-500">
                            @if (file_exists(public_path('imgs/previews/' . $project->project_name . '.jpg')))
                                <img src="{{ asset('imgs/previews/' . $project->project_name . '.jpg') }}" alt="Preview of {{ $project->project_name }}" class="w-full h-full object-cover rounded-md">
                            @else
                                {{ __('content.projects.alternative_text') }}
                            @endif
                        </div>
                        <div class="">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                                {{ __('projects.' . $project->project_name . '.title') }}
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ __('projects.' . $project->project_name . '.description') }}
                            </p>
                        </div>
                    </container>

                    @if ($project->tools)
                        <tools class="mt-4 space
                        -x-2">
                            @foreach (explode(',', $project->tools) as $tool)
                                <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 text-sm px-2 py-1 rounded-full">
                                    {{ trim($tool) }}
                                </span>
                            @endforeach
                        </tools>
                    @endif
                </a>
            @endforeach
        </div>

    <script>
        // Make a script that change the color of each tools text depending on the tool name
        document.querySelectorAll('tools span').forEach(span => {
            const tool = span.textContent.toLowerCase();
            let colorClass = 'text-gray-800 dark:text-gray-300'; // Default color

            if (tool.includes('laravel')) {
                colorClass = 'text-red-600 dark:text-red-400';
            } else if (tool.includes('livewire')) {
                colorClass = 'text-blue-600 dark:text-blue-400';
            } else if (tool.includes('tailwindcss')) {
                colorClass = 'text-teal-600 dark:text-teal-400';
            } else if (tool.includes('mysql')) {
                colorClass = 'text-orange-600 dark:text-orange-400';
            } else if (tool.includes('charts')) {
                colorClass = 'text-purple-600 dark:text-purple-400';
            } else if (tool.includes('http client')) {
                colorClass = 'text-yellow-600 dark:text-yellow-400';
            }

            span.className = `inline-block bg-gray-200 dark:bg-gray-700 ${colorClass} text-sm px-2 py-1 rounded-full`;
        });
    </script>

@endsection