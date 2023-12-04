<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageRolesController;
use App\Livewire\AdminDashboard;
use App\Livewire\ConstituencyTypeManager;

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

Route::get('/admin/constituency-type-manager', ConstituencyTypeManager::class)
    ->middleware(['auth', 'verified'])
    ->name('admin/constituency-type-manager');

require __DIR__.'/auth.php';
