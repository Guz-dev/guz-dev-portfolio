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

    <div class="container mx-auto p-4 max-w-md">
        <h1 class="text-center text-2xl font-bold mb-6">
            {{ __('projects.todos.title') }}
        </h1>
        <div class="flex gap-2">
            <import-container class="flex w-full items-center justify-between gap-1 mb-4">
                <input 
                wire:model="todoFile" 
                type="file" 
                id="todoFile" 
                accept=".txt"
                class="border border-gray-300 rounded px-3 py-2 cursor-pointer text-sm text-gray-700 w-52 dark:bg-[#19140035] dark:text-[#EDEDEC]">

                <button 
                    wire:click="importTodos" 
                    @if(!$todoFile) disabled @endif
                    class="text-white text-sm rounded px-4 py-2 transition 
                        @if($todoFile) bg-green-500 hover:bg-green-600 cursor-pointer 
                        @else bg-green-700 cursor-not-allowed opacity-60 @endif">
                    {{ __('projects.todos.importButton') }}
                </button>
            </import-container>
        </div>
    
        @error('todoFile') 
            <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
        @enderror
    
        <div class="mb-6 space-y-4">
            <!-- Add Todo Form -->
            <form wire:submit.prevent="addTodo" class="flex items-center gap-2">
                <input 
                    type="text" 
                    wire:model="newTodo" 
                    placeholder="{{ __('projects.todos.addButtonTooltip') }}" 
                    class="flex-1 border border-gray-300 rounded px-3 py-2 dark:bg-[#19140035] dark:text-[#EDEDEC]" 
                >
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600 cursor-pointer"
                >
                    {{ __('projects.todos.addButton') }}
                </button>
            </form>

        </div>
        
        <div class="space-y-4 rounded-xl bg-white p-4 shadow-sm dark:bg-gray-900">
            <div class="flex items-center justify-between">
                <button 
                    wire:click="clearTodos" 
                    class="text-red-500 text-sm font-medium hover:underline transition"
                >
                    {{ __('projects.todos.clearButton') }}
                </button>

                <button 
                    wire:click="exportAsNote" 
                    class="bg-blue-500 text-white text-sm rounded px-4 py-2 hover:bg-blue-600 transition cursor-pointer"
                >
                    {{ __('projects.todos.exportButton') }}
                </button>
            </div>

            <ul class="space-y-3">
                @foreach($todos as $index => $todo)
                    <li class="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 transition-shadow shadow-sm">
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                wire:model.live="todos.{{ $index }}.completed"
                                class="mr-3 h-5 w-5 text-blue-500 transition duration-200 rounded focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-700"
                            >
                            <span @class([
                                'text-base transition-all duration-200',
                                'text-gray-700 dark:text-gray-300' => !$todo['completed'],
                                'line-through text-gray-400 dark:text-gray-500' => $todo['completed'],
                            ])>
                                {{ $todo['text'] }}
                            </span>
                        </div>
                        <button 
                            wire:click="removeTodo({{ $index }})"
                            class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded-lg transition duration-200 shadow-sm cursor-pointer"
                        >
                            {{ __('projects.todos.removeButton') }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    
        @script
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('notify', (event) => {
                    alert(event.message);
                });
            });
        </script>
        @endscript
    </div>
</div>