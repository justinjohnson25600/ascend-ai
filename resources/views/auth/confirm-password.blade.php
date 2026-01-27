@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Confirm password</h1>
        <p class="text-gray-400 mt-2">For your security, please confirm your password to continue</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20">
            <ul class="text-sm text-red-400 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                Password
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="w-full px-4 py-3 bg-navy-900/50 border border-navy-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-colors"
                placeholder="••••••••"
            >
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full btn btn-primary py-3 text-lg"
        >
            Confirm password
        </button>
    </form>
@endsection
