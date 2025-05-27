@extends('layouts.app')

@section('title', 'Projects')

@section('content')
{{-- make placeholders --}}
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white text-center">
            {{ __('content.projects.title') }}
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            {{-- Proyecto 1: To-do List --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset('imgs/previews/todos.jpg') }}" alt="Vista previa Todo List" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                        {{ __('projects.todos.title') }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        Lista de tareas desarrollada con <span class="font-medium text-blue-600 dark:text-blue-400">Livewire</span> y <span class="font-medium text-emerald-600 dark:text-emerald-400">TailwindCSS</span>. Permite agregar, marcar como completado, eliminar, importar y exportar tareas.
                    </p>
                </div>
            </div>

            {{-- Placeholder Proyecto 2 --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col items-center justify-center p-5">
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-md mb-4 flex items-center justify-center text-gray-400 dark:text-gray-500">
                    Imagen del proyecto
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2 text-center">
                    Proyecto en desarrollo
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-300 text-center">
                    Próximamente más información sobre este proyecto.
                </p>
            </div>

            {{-- Placeholder Proyecto 3 --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col items-center justify-center p-5">
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-md mb-4 flex items-center justify-center text-gray-400 dark:text-gray-500">
                    Imagen del proyecto
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2 text-center">
                    Proyecto en desarrollo
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-300 text-center">
                    Próximamente más información sobre este proyecto.
                </p>
            </div>

            {{-- Placeholder Proyecto 4 --}}
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col items-center justify-center p-5">
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-md mb-4 flex items-center justify-center text-gray-400 dark:text-gray-500">
                    Imagen del proyecto
                </div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-2 text-center">
                    Proyecto en desarrollo
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-300 text-center">
                    Próximamente más información sobre este proyecto.
                </p>
            </div>
        </div>
    </div>

@endsection