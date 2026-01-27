@extends('layouts.app')

@section('title', 'Profile')

@section('description', 'Manage your Ascend AI profile')

@section('content')
<div class="container-narrow py-16">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-display-md font-bold mb-2">Profile</h1>
        <p class="text-gray-400">Update your account's profile information and email address.</p>
    </div>

    {{-- Profile Update Form --}}
    <div class="card-glass p-8 mb-8">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                    Name
                </label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ Auth::user()->name }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full px-4 py-3 bg-navy-900/50 border border-navy-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-colors"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                    Email
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ Auth::user()->email }}"
                    required
                    autocomplete="email"
                    class="w-full px-4 py-3 bg-navy-900/50 border border-navy-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-colors"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror

                @if ($mustVerifyEmail && Auth::user()->email_verified_at === null)
                    <div class="mt-4 p-3 rounded-lg bg-yellow-500/10 border border-yellow-500/20">
                        <p class="text-sm text-yellow-400">
                            Your email address is unverified.
                            <form method="POST" action="{{ route('verification.send') }}" class="inline">
                                @csrf
                                <button type="submit" class="underline text-yellow-400 hover:text-yellow-300">
                                    Click here to re-send the verification email.
                                </button>
                            </form>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button type="submit" class="btn btn-primary px-6 py-3">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Delete Account Section --}}
    <div class="card-glass p-8 border border-red-500/20">
        <h2 class="text-lg font-semibold text-red-400 mb-4">Delete Account</h2>
        <p class="text-gray-400 mb-6">
            Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.
        </p>

        <button
            x-data="{ showModal: false }"
            @click="$dispatch('open-delete-account-modal')"
            class="btn bg-red-500/10 text-red-400 hover:bg-red-500/20 border border-red-500/20 px-4 py-2"
        >
            Delete Account
        </button>
    </div>
</div>

{{-- Delete Account Modal --}}
<div x-data="{ isOpen: false }" @open-delete-account-modal.window="isOpen = true" x-show="isOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
    {{-- Backdrop --}}
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/80" @click="isOpen = false"></div>

    {{-- Modal --}}
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative bg-navy-900 border border-navy-700 rounded-xl p-6 max-w-md w-full shadow-xl">
        <h3 class="text-lg font-semibold text-white mb-2">Delete Account</h3>
        <p class="text-gray-400 mb-6">Are you sure you want to delete your account? All data will be permanently removed.</p>

        <div class="flex justify-end gap-3">
            <button @click="isOpen = false" class="btn btn-ghost px-4 py-2">
                Cancel
            </button>
            <form method="POST" action="{{ route('profile.destroy') }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600 px-4 py-2">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
