<div>
    @section('title', 'To-dos')

    @if(session()->has('message'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
{{-- 
    <div class="mx-auto p-2 max-w-2xl">
        <h1 class="text-center text-2xl font-bold mb-6">
            {{ __('projects.pharmacy-manager.title') }}
        </h1>

        @foreach(range(1, 7) as $i)
            <div class="mb-6">
                <img src="{{ asset('imgs/previews/pharmacy-manager/' . $i . '.jpg') }}" alt="Image {{ $i }} of 7" class="w-full h-auto rounded shadow">
                <p class="mt-2 text-center text-black dark:text-gray-300">
                    {{ __('projects.pharmacy-manager.description' . $i) }}
                </p>
            </div>
        @endforeach
    </div>
 --}}

    {{-- make it an animated slider with all images --}}
    <div class="mx-auto p-2 max-w-5xl">
        <h1 class="text-center text-2xl font-bold mb-6">
            {{ __('projects.pharmacy-manager.title') }}
        </h1>

        <slider-container class="flex flex-col justify-center items-center gap-4">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-200" style="transform: translateX(-{{ $currentIndex * 100 }}%);">
                    @foreach(range(1, 7) as $i)
                        <div class="min-w-full">
                            <img src="{{ asset('imgs/previews/pharmacy-manager/' . $i . '.jpg') }}" alt="Image {{ $i }} of 7" class="w-full cover h-[400px] rounded shadow">
                            <p class="mt-2 text-center text-black dark:text-gray-300 text-lg">
                                {{ __('projects.pharmacy-manager.description' . $i) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <slider-buttons class="flex gap-4">
                <button wire:click="previous" class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 focus:outline-none cursor-pointer">
                    &#8592;
                </button>
                <button wire:click="next" class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 focus:outline-none cursor-pointer">
                    &#8594;
                </button>
            </slider-buttons>
        </slider-container>
    </div>
</div>
