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
        <todo-header class="flex flex-col items-center justify-between w-max mb-4 gap-2">
            <h1 class="text-2xl font-bold mb-4 dark:text-white">To-do List {{ __('auth.failed') }} </h1>
            <div class="flex gap-2">
                
                
                <import-container class="flex items-center justify-center gap-1 mb-4">
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
                        Import Todos
                    </button>
                </import-container>
            </div>
        </todo-header>
    
        @error('todoFile') 
            <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
        @enderror
    
        <div class="mb-6 space-y-4">
            <!-- Add Todo Form -->
            <form wire:submit.prevent="addTodo" class="flex items-center gap-2">
                <input 
                    type="text" 
                    wire:model="newTodo" 
                    placeholder="Add a new to-do" 
                    class="flex-1 border border-gray-300 rounded px-3 py-2 dark:bg-[#19140035] dark:text-[#EDEDEC]" 
                >
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600 cursor-pointer"
                >
                    Add
                </button>
            </form>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between gap-2">
                <button 
                    wire:click="clearTodos" 
                    class="text-red-500 text-sm hover:underline cursor-pointer"
                >
                    Clear All
                </button>

                <button 
                    wire:click="exportAsNote" 
                    class="bg-blue-500 text-white text-sm rounded px-4 py-2 hover:bg-blue-600 cursor-pointer"
                >
                    Export as Note
                </button>
            </div>
        </div>
        
        <ul class="space-y-2">
            @foreach($todos as $index => $todo)
                <li class="flex items-center justify-between p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="todos.{{ $index }}.completed" 
                               class="mr-2 h-5 w-5 text-blue-500 rounded">
                        <span @class([
                            'text-gray-700 dark:text-gray-300',
                            'line-through text-gray-400' => $todo['completed']
                        ])>
                            {{ $todo['text'] }}
                        </span>
                    </div>
                    <button wire:click="removeTodo({{ $index }})" 
                            class="bg-red-500 text-white rounded p-1 hover:bg-red-600">
                        Remove
                    </button>
                </li>
            @endforeach
        </ul>
    
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