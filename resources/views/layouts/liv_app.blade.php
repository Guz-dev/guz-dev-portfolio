<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title') - {{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        @livewireStyles
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 items-center justify-center min-h-screen flex-col transition-colors duration-300 ease-in-out dark:text-[#EDEDEC]">
        <header class="w-full text-sm mb-6 mx-auto">
            <div class="flex items-center justify-between relative">
                <!-- Espacio vacío a la izquierda para balancear -->
                <div class="flex-1"></div>
                
                <!-- Nav centrado -->
                <nav class="flex items-center justify-center gap-4">
                    <a href="{{ route('home') }}" wire:navigate class="px-3 py-1.5 min-w-28 text-center dark:text-[#EDEDEC] border-[#57575735] hover:border-[#0000004a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        {{ __('content.nav.home') }}
                    </a>
                    <a href="{{ route('about') }}" wire:navigate class="px-3 py-1.5 min-w-28 text-center dark:text-[#EDEDEC] border-[#57575735] hover:border-[#0000004a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        {{ __('content.nav.about') }}
                    </a>
                    <a href="{{ route('projects') }}" wire:navigate class="px-3 py-1.5 min-w-28 text-center dark:text-[#EDEDEC] border-[#57575735] hover:border-[#0000004a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        {{ __('content.nav.projects') }}
                    </a>
                    <a href="{{ route('contact') }}" wire:navigate class="px-3 py-1.5 min-w-28 text-center dark:text-[#EDEDEC] border-[#57575735] hover:border-[#0000004a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        {{ __('content.nav.contact') }}
                    </a>
                </nav>
                
                <!-- Botón de idioma a la derecha -->
                <div class="flex-1 flex justify-end">
                    <form action="{{ route('language.toggle') }}" method="POST" class="inline-flex">
                        @csrf
                        <button 
                            type="submit" 
                            class="text-lg px-3 py-1 rounded bg-gray-200 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 cursor-pointer transition-colors duration-300 ease-in-out font-mono"
                            title="{{ app()->getLocale() === 'es' ? 'Switch to English' : 'Cambiar a Español' }}"
                        >
                            {{ app()->getLocale() === 'es' ? '🇺🇸' : '🇪🇸' }}
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <div class="flex items-start justify-center w-full transition-opacity opacity-100 duration-750 grow starting:opacity-0 mt-20">
            {{ $slot }}
        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
