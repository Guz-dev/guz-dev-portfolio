<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Livewire\Home;

use App\Livewire\Projects\PharmacyManager\PharmacyManager;
use App\Livewire\Projects\Todos\Todos;
use App\Livewire\Projects\EarthquakeTracker\EarthquakeTracker;

Route::get('/', Home::class)->name('home');
Route::post('/language-toggle', [HomeController::class, 'languageToggle'])->name('language.toggle');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware('throttle:mail')->group(function () {
    Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');
});

Route::middleware('throttle:download_resume')->group(function () {
    Route::get('/resume', [HomeController::class, 'getResume'])->name('resume');
});

Route::prefix('projects')->group(function () {
    Route::get('/', [HomeController::class, 'projects'])->name('projects');
    Route::get('/pharmacy-manager', PharmacyManager::class)->name('projects.pharmacy-manager');
    Route::get('/todos', Todos::class)->name('projects.todos');
    Route::get('/earthquake-tracker', EarthquakeTracker::class)->name('projects.earthquake-tracker');
    Route::get('/project3', [HomeController::class, 'project3'])->name('project3');
});
