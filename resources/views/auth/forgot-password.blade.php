@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Forgot password?</h1>
        <p class="text-gray-400 mt-2">No problem. We'll send you reset instructions.</p>
    </div>

    <!-- Status Message -->
    @if (session('status'))
        <div class="mb-4 p-3 rounded-lg bg-green-500/10 border border-green-500/20">
            <p class="text-sm text-green-400">{{ session('status') }}</p>
        </div>
    @endif

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
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                Email address
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
                class="w-full px-4 py-3 bg-navy-900/50 border border-navy-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-colors"
                placeholder="you@example.com"
            >
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full btn btn-primary py-3 text-lg"
        >
            Send reset link
        </button>
    </form>

    <!-- Back to Login -->
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-accent-400 hover:text-accent-300 transition-colors">
            &larr; Back to login
        </a>
    </div>
@endsection
