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
use App\Livewire\Voting\Elections;
use App\Livewire\Voting\Parties\Dashboard as PartiesDashboard;

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
    'voting',
    'voting/elections',
    'voting/elections/types',
    'voting/elections/dashboard',
    'voting/elections/types/dashboard',
    'create',
    'handle',
    'latest',
    'profile',
    'you',
    't',
    'torrents',
    'torrent',
    'h',
    'hashtags',
    'hashtag',
    'theking',
    'commons',
    'lords',
    'top',
    'bills',
    'cabinet',
    'pm',
    'chancellor',
    'scotland',
    'wales',
    'northern-ireland',
    'member',
    'm',
];

Route::view('/', 'welcome');

Route::middleware('check.handle')->group(function () {
    // Routes that require a handle...
    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
});

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

Route::get('/handle', \App\Livewire\Profile\Handle::class)
    ->middleware(['auth'])
    ->name('handle');

Route::get('/create', \App\Livewire\CreateTorrent::class)->name('create');

Route::get('/latest', \App\Livewire\Torrents\Latest::class)->name('latest');

Route::get('/bills', \App\Livewire\Legislation\Bills::class)->name('bills');

Route::get('/hashtags', Hashtags::class)->name('hashtags');

Route::get('/h/{hashtag}', Hashtags::class)->name('hashtag');

Route::get('/m/{id}', App\Livewire\DecisionMakers\Dashboard::class)->name('decisionmaker');

// If the route is *not* within the list of reserved routes, assume we are trying to view a user's profile and send them to the profile page for that user.
Route::get('/{handle}', Spring::class)->where('handle', '^(?!' . implode('|', $reservedRouteSlugs) . ').*');

// Definte the route for a single torrent. this should be /t/{torrentId}
Route::get('/t/{torrentId}', \App\Livewire\Torrents\Permalink::class)->name('torrent');

Route::get('/decision-makers/dashboard', \App\Livewire\DecisionMakers\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('decision-makers/dashboard');

Route::get('/top', \App\Livewire\DecisionMakers\Top::class)
    ->name('top');

Route::get('/theking', \App\Livewire\DecisionMakers\Monarchy\TheSovereign::class)
    ->name('theking');

Route::get('/thequeen', \App\Livewire\DecisionMakers\Monarchy\TheQueen::class)
    ->name('thequeen');

Route::get('/cabinet', \App\Livewire\DecisionMakers\Cabinet::class)
    ->name('cabinet');

Route::get('/pm', \App\Livewire\DecisionMakers\Cabinet\PrimeMinister::class)
    ->name('pm');

Route::get('/chancellor', \App\Livewire\DecisionMakers\Cabinet\Chancellor::class)
    ->name('chancellor');

Route::get('/commons', \App\Livewire\DecisionMakers\Parliament\Commons::class)
    ->name('commons');

Route::get('/lords', \App\Livewire\DecisionMakers\Parliament\Lords::class)
    ->name('lords');

Route::get('/scotland', \App\Livewire\DecisionMakers\Devolved\Scotland::class)
    ->name('scotland');

Route::get('/wales', \App\Livewire\DecisionMakers\Devolved\Wales::class)
    ->name('wales');

Route::get('/northern-ireland', \App\Livewire\DecisionMakers\Devolved\NorthernIreland::class)
    ->name('northern-ireland');

Route::get('/voting/elections', Elections\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('voting/elections');

Route::get('/voting/elections/types', Elections\Types::class)
    ->middleware(['auth', 'verified'])
    ->name('voting/elections/types');

Route::get('/voting/parties', PartiesDashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('voting/parties');


require __DIR__.'/auth.php';
