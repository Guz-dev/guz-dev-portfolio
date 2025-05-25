<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Livewire\Projects\Todos\Todos;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/language-toggle', [HomeController::class, 'languageToggle'])->name('language.toggle');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');


Route::prefix('projects')->group(function () {
    Route::get('/', [HomeController::class, 'projects'])->name('projects');
    Route::get('/todos', Todos::class)->name('projects.todos');
    Route::get('/project2', [HomeController::class, 'project2'])->name('project2');
    Route::get('/project3', [HomeController::class, 'project3'])->name('project3');
});
