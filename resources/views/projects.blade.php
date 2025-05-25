@extends('layouts.app')

@section('title', 'Projects')

@section('content')
{{-- make placeholders --}}
    <div class="flex flex-col items-center justify-center w-full dark:text-white">
        <h1 class="text-3xl font-bold text-center mb-4">Projects</h1>
        <p class="text-lg text-center mb-4">Here are some of my projects:</p>
        <ul class="list-disc list-inside">
            <li class="mb-2"><a href="{{ route('projects.todos') }}" wire:navigate class="dark:text-white hover:underline">Project "Todos"</a></li>
            <li class="mb-2"><a href="#" class="dark:text-white hover:underline">Project 2</a></li>
            <li class="mb-2"><a href="#" class="dark:text-white hover:underline">Project 3</a></li>
        </ul>
    </div>
@endsection