<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AdminDashboard;
use App\Livewire\ConstituencyManager\Dashboard;
use App\Livewire\ConstituencyManager\Constituencies;
use App\Livewire\ConstituencyManager\Types;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Livewire\Profile\Spring;
use App\Livewire\Hashtags;

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

$reservedRouteSlugs = [
    'login',
    'register',
    'admin',
    'dashboard',
    'decision-makers',
    'decision-makers/dashboard',
    'decision-makers/hoc-members',
    'constituency-manager',
    'constituency-manager/dashboard',
    'constituency-manager/constituencies',
    'constituency-manager/types',
    'create',
    'latest',
    'profile',
    'you',
];

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

Route::get('/hashtags', Hashtags::class)->name('hashtags');

// If the route is *not* within the list of reserved routes, assume we are trying to view a user's profile and send them to the profile page for that user.
Route::get('/{handle}', Spring::class)->where('handle', '^(?!' . implode('|', $reservedRouteSlugs) . ').*');

Route::get('/decision-makers/dashboard', \App\Livewire\DecisionMakers\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('decision-makers/dashboard');

Route::get('/decision-makers/hoc-members', \App\Livewire\DecisionMakers\UKParliamentMembers::class)
    ->middleware(['auth', 'verified'])
    ->name('decision-makers/hoc-members');

require __DIR__.'/auth.php';
