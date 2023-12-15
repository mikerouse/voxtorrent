<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AdminDashboard;
use App\Livewire\ConstituencyManager\Dashboard;
use App\Livewire\ConstituencyManager\Constituencies;
use App\Livewire\ConstituencyManager\Types;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('admin', 'livewire.admin-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin');

Route::get('/constituency-manager/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('constituency-manager/dashboard');

// Define the route for Constituencies
Route::get('/constituency-manager/constituencies', Constituencies::class)
    ->name('constituency-manager.constituencies')
    ->middleware(['auth', 'verified']);

// Define the route for Types
Route::get('/constituency-manager/types', Types::class)
    ->name('constituency-manager.types')
    ->middleware(['auth', 'verified']);

Route::get('/create', \App\Livewire\CreateTorrent::class)->name('create');

Route::get('/latest', \App\Livewire\Torrents\Latest::class)->name('latest');

Route::get('/decision-makers/dashboard', \App\Livewire\DecisionMakers\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('decision-makers/dashboard');

Route::get('/decision-makers/hoc-members', \App\Livewire\DecisionMakers\UKParliamentMembers::class)
    ->middleware(['auth', 'verified'])
    ->name('decision-makers/hoc-members');

require __DIR__.'/auth.php';
