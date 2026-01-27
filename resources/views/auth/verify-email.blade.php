@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Verify your email</h1>
        <p class="text-gray-400 mt-2">Please verify your email address to continue</p>
    </div>

    <!-- Resend Link -->
    <div class="text-center py-4">
        <p class="text-gray-300 mb-4">
            Before continuing, could you verify your email address by clicking on the link we just emailed to you?
        </p>
        <p class="text-gray-400 text-sm">
            If you didn't receive the email, we'll gladly send you another.
        </p>
    </div>

    <!-- Status Message -->
    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 p-3 rounded-lg bg-green-500/10 border border-green-500/20">
            <p class="text-sm text-green-400">
                A new verification link has been sent to your email address.
            </p>
        </div>
    @endif

    <!-- Resend Button -->
    <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
        @csrf

        <button
            type="submit"
            class="w-full btn btn-primary py-3 text-lg"
        >
            Resend verification email
        </button>
    </form>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button
            type="submit"
            class="w-full btn btn-ghost py-2 text-sm text-gray-400 hover:text-white"
        >
            Log out
        </button>
    </form>
@endsection
