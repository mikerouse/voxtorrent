<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageRolesController;

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

    Route::get('/manage-roles', \App\Livewire\RolesTable::class)
    ->middleware(['auth', 'can:manage-roles'])
    ->name('manage-roles.index');

Route::get('/manage-roles/create', \App\Livewire\CreateRole::class)
    ->middleware(['auth', 'can:manage-roles'])
    ->name('manage-roles.create');

Route::get('/manage-roles/edit/{role}', \App\Livewire\EditRole::class)
    ->name('manage-roles.edit');

Route::delete('/manage-roles/{role}', \App\Livewire\DeleteRole::class)
    ->middleware(['auth', 'can:manage-roles'])
    ->name('manage-roles.destroy');

require __DIR__.'/auth.php';
