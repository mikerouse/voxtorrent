<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div id="primary-navigation-sidebar" class="py-6">
    <nav class="p-6 mt-0 w-full"> 
        <div class="container mx-auto flex flex-col items-start">
            <div class="text-white font-extrabold mb-4">
                <a class="text-white no-underline hover:text-white hover:no-underline" href="/">
                    <span class="text-2xl pl-0">vime</span>
                </a>
            </div>
            <div class="mb-4 p-0 w-full">
                <a href="/create" class="inline-flex w-full items-center justify-center py-4 px-6 border border-transparent text-base font-bold rounded-md text-white bg-orange-600 hover:bg-red-600">
                    <i class="fa-regular fa-pen-to-square mr-2"></i> create
                </a>
            </div>
            <ul class="list-reset flex flex-col justify-between flex-1 items-start dark:text-white">
                <li class="mb-3 flex items-center">
                    <a class="inline-block py-2 text-gray-300 no-underline" href="{{ route('latest') }}">
                        <i class="fas fa-timeline mr-4"></i>latest
                    </a>
                </li>
                <li class="mb-3 flex items-center">
                    <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('latest') }}">
                        <i class="fas fa-arrow-up-right-dots mr-4"></i>uprising
                    </a>
                </li>
                <li class="mb-3 flex items-center">
                    <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('bills') }}">
                        <i class="fas fa-file-contract mr-4"></i>bills
                    </a>
                </li>
                <li class="mb-3 flex items-center">
                    <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('top') }}">
                        <i class="fas fa-shower mr-4"></i>decision makers
                    </a>
                </li>
                <li class="mb-3 flex items-center">
                    <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('hashtags') }}">
                        <i class="fas fa-hashtag mr-4"></i>hashtags
                    </a>
                </li>
            </ul>
            @auth
                <div class="text-white font-light mt-4 mb-4">
                    <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                        <span class="text-2xl pl-0">{{ auth()->user()->handle }}</span>
                    </a>
                </div>
                <ul class="list-reset flex flex-col justify-between flex-1 items-start dark:text-white">
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="/{{ auth()->user()->handle }}">
                            <i class="fas fa-circle-user mr-4"></i>your profile
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('dashboard') }}">
                            <i class="fas fa-briefcase mr-4"></i>tools
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('profile') }}">
                            <i class="fas fa-cog mr-4"></i>user settings
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <button wire:click="logout" class="inline-block text-left text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2">
                            <i class="fas fa-arrow-right-from-bracket mr-4"></i> {{ __('Log Out') }}
                        </button>
                    </li>
                </ul>  
            @endauth
            @guest
                <div class="text-white font-light mt-4 mb-4">
                    <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                        <span class="text-2xl pl-0">welcome</span>
                    </a>
                </div>
                <ul class="list-reset flex flex-col justify-between flex-1 items-start dark:text-white">
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('register') }}">
                            <i class="fas fa-briefcase mr-4"></i>register
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('profile') }}">
                            <i class="fas fa-circle-user mr-4"></i>log in
                        </a>
                    </li>
                </ul>  
            @endguest
            @can('do anything')
                <div class="text-white font-light mt-4 mb-4">
                    <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                        <span class="text-2xl pl-0">super admin</span>
                    </a>
                </div>
                <ul class="list-reset flex flex-col justify-between flex-1 items-start dark:text-white">
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('admin') }}">
                            <i class="fas fa-briefcase mr-4"></i>admin dashboard
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('constituency-manager/dashboard') }}">
                            <i class="fas fa-circle-user mr-4"></i>constituencies
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('voting/elections') }}">
                            <i class="fas fa-check-to-slot mr-4"></i>elections
                        </a>
                    </li>
                    <li class="mb-3 flex items-center">
                        <a class="inline-block py-2 text-gray-500 no-underline" href="{{ route('voting/parties') }}">
                            <i class="fas fa-democrat mr-4"></i>political parties
                        </a>
                    </li>
                </ul>  
            @endcan
        </div>
    </nav> 
</div>