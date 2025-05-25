@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    {{-- create a contact form with name, email and message fields --}}
    <div class="flex flex-col items-center justify-center w-full dark:text-white">
        <h1 class="text-3xl font-bold text-center mb-4">Contact me</h1>
        <form action="{{ route('contact.send') }}" method="POST" class="w-full max-w-sm">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" placeholder="Your name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" placeholder="Your email">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-white">Message</label>
                <textarea name="message" id="message" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Send</button>
        </form>
    </div>
@endsection