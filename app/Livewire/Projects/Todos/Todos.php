<?php

namespace App\Livewire\Projects\Todos;

use Livewire\Component;
use Livewire\WithFileUploads;

class Todos extends Component
{
    use WithFileUploads;

    public $todos = [];
    public $newTodo = '';
    public $todoFile;

    protected $rules = [
        'todoFile' => 'required|file|mimes:txt',
    ];

    public function mount()
    {
        $this->todos = [];
    }

    public function addTodo()
    {
        if (!empty($this->newTodo)) {
            $this->todos[] = [
                'text' => $this->newTodo,
                'completed' => false
            ];
            $this->newTodo = '';
        }
    }

    public function removeTodo($index)
    {
        unset($this->todos[$index]);
        $this->todos = array_values($this->todos);
    }

    public function clearTodos()
    {
        $this->todos = [];
    }

    public function exportAsNote()
    {
        $content = "";
        foreach ($this->todos as $todo) {
            $status = $todo['completed'] ? '[x]' : '[ ]';
            $content .= "{$status} {$todo['text']}\n";
        }

        return response()->streamDownload(
            fn() => print($content),
            'todos.txt'
        );
    }

    public function importTodos()
    {
        $this->validate();
        try {
        $content = file_get_contents($this->todoFile->getRealPath());
        $lines = array_filter(explode("\n", $content), fn($line) => trim($line) !== '');

        foreach ($lines as $line) {
            $line = trim($line);

            // Check for checkbox-style line: [x] Task or [ ] Task
            if (preg_match('/^\[\s*(x?)\s*\]\s*(.+)$/i', $line, $matches)) {
                $this->todos[] = [
                    'text' => trim($matches[2]), // exclude [x] or [ ]
                    'completed' => strtolower($matches[1]) === 'x'
                ];
            }
            // Handle title|content format
            elseif (str_contains($line, '|')) {
                $parts = explode('|', $line, 2);
                $this->todos[] = [
                    'text' => trim($parts[1] ?? $parts[0]),
                    'completed' => false
                ];
            }
            // Handle plain text
            else {
                $this->todos[] = [
                    'text' => $line,
                    'completed' => false
                ];
            }
        }

            $this->dispatch('notify', type: 'success', message: 'Todos imported successfully!');
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Import failed: ' . $e->getMessage());
        }

        $this->reset('todoFile');
    }

    public function render()
    {
        return view('livewire.projects.todos.todos');
    }
}
