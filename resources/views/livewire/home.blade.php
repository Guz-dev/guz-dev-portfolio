@section('title', __('content.home.title'))

<div class="flex flex-col items-center justify-center w-full dark:text-white">
    <h1 class="text-3xl font-bold text-center mb-4"> {{ __('content.home.name') }} </h1>
    <p class="w-8/12 text-lg text-center mb-4"> {{ __('content.home.description') }}</p>

    <a href="{{ route('resume') }}" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 cursor-pointer">
        {{ __('content.home.resume_link') }}
    </a>

    <div class="w-full mt-10">
        <h2 class="text-2xl font-bold text-center mb-6 dark:text-white">
            {{ __('content.home.experience_title') }}
        </h2>

        <ol class="relative border-s border-gray-300 dark:border-gray-700 max-w-3xl mx-auto">
            @foreach(['camarones', 'dici', 'dlo'] as $key)
                <li class="mb-10 ms-6">
                    <span class="absolute w-3 h-3 bg-blue-500 rounded-full -start-1.5 top-1.5 border border-white dark:border-gray-800"></span>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('content.home.experiences.' . $key . '.position') }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('content.home.experiences.' . $key . '.place') }} — 
                        {{ __('content.home.experiences.' . $key . '.date') }}
                    </p>
                    <button 
                        wire:click="openModal('{{ $key }}')"
                        class="text-blue-500 text-sm mt-2 hover:underline cursor-pointer"
                    >
                        Ver más
                    </button>
                </li>
            @endforeach
        </ol>

        {{-- Modal --}}
        @if($selected)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 w-11/12 max-w-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-2 dark:text-white">
                        {{ __('content.home.experiences.' . $selected . '.position') }}
                    </h2>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ __('content.home.experiences.' . $selected . '.place') }}
                    </p>
                    <p class="text-sm text-gray-500 mb-4">
                        {{ __('content.home.experiences.' . $selected . '.date') }}
                    </p>
                    <p class="text-base leading-relaxed dark:text-gray-300">
                        {{ __('content.home.experiences.' . $selected . '.desc') }}
                    </p>
                    <div class="text-right mt-6">
                        <button wire:click="closeModal"
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded cursor-pointer">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
