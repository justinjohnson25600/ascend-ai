@extends('layouts.auth')

@section('title', 'Log in')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Welcome back</h1>
        <p class="text-gray-400 mt-2">Sign in to your account</p>
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
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
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

        <!-- Remember & Forgot Password -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input
                    type="checkbox"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-navy-700 bg-navy-900/50 text-accent-500 focus:ring-accent-500 focus:ring-offset-navy-950"
                >
                <span class="ml-2 text-sm text-gray-400">Remember me</span>
            </label>

            @if ($canResetPassword)
                <a href="{{ route('password.request') }}" class="text-sm text-accent-400 hover:text-accent-300 transition-colors">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full btn btn-primary py-3 text-lg"
        >
            Sign in
        </button>
    </form>

    <!-- Register Link -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-accent-400 hover:text-accent-300 font-medium transition-colors">
                Sign up
            </a>
        </p>
    </div>
@endsection
