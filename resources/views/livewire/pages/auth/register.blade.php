<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $location = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create([
            'name' => $this->name,
            'location' => $this->location,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_verified' => false,
            'is_active' => true,
            'is_protected' => false,
            'handle' => '',
            'thumbnail_url' => '',
            'cover_url' => '',
            'is_suspended' => false,
            'is_banned' => false,
            'is_deleted' => false,
            'is_flagged' => false,
            'gender' => '',
            'date_of_birth' => null,
            'phone' => '',
            'primary_constituency_id' => 0,
            'primary_political_party_id' => 0,
            'job_title' => '',
            'bio' => '',
            'hometown' => '',
            'is_decision_maker' => false,
            'is_mayor' => false,
            'is_mp' => false,
            'is_governor' => false,
            'is_senator' => false,
            'is_president' => false,
            'is_vip' => false,
            'is_team_member' => false,
            'is_team_admin' => false,
            'is_team_owner' => false,
            'is_featured' => false,
            'followers_count' => 0,
            'following_count' => 0,
            'posts_count' => 0,
            'comments_count' => 0,
            'likes_count' => 0,
            'dislikes_count' => 0,
            'shares_count' => 0,
            'flags_count' => 0,
            'views_count' => 1,
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
            'last_login_device' => request()->userAgent(),
            'last_login_location' => '',
            'last_login_country' => '',
            'last_login_region' => '',
        ]);

        // Validate the user
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the user
        $createdUser = User::create($user);
        // event(new Registered($createdUser));

        // If this is the first user, make them a 'super admin'
        if (User::count() == 1) {
            // assign 'Super Admin' role to the first user
            $user->assignRole('super admin');
        }

        // Check if email ends with @bluetorch.co.uk
        if (str_ends_with($user->email, '@bluetorch.co.uk')) {
            // assign 'Super Admin' role to the user
            $user->assignRole('super admin');
        }

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('real name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="location">
                {{ __('location (nearest town or city)') }}
            </label>
            <input wire:model="location" {{ wep_insert(['town-city']) }} id="location" class="block mt-1 w-full" type="text" name="location" required autofocus autocomplete="city" />
            {{-- <x-input-error :messages="$errors->get('location')" class="mt-2" /> --}}
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('repeat password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
