@php
    $title = 'Dashboard';
    $description = 'Your Ascend AI dashboard';
@endphp

<x-layout.app :title="$title" :description="$description">
    <div class="container-narrow py-16">
        {{-- Welcome Section --}}
        <div class="card-glass p-8 mb-8">
            <h1 class="text-display-md font-bold mb-2">
                Welcome back, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-400">
                You're logged in to Ascend AI.
            </p>
        </div>

        {{-- User Info Card --}}
        <div class="card-glass p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Account Information</h2>
            <div class="space-y-3">
                <div>
                    <span class="text-gray-400 text-sm">Name:</span>
                    <p class="text-white">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <span class="text-gray-400 text-sm">Email:</span>
                    <p class="text-white">{{ Auth::user()->email }}</p>
                </div>
                @if (Auth::user()->email_verified_at)
                    <div>
                        <span class="text-gray-400 text-sm">Email verified:</span>
                        <p class="text-green-400">{{ Auth::user()->email_verified_at->format('F j, Y') }}</p>
                    </div>
                @else
                    <div>
                        <span class="text-gray-400 text-sm">Email verified:</span>
                        <p class="text-yellow-400">Not verified</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('profile.edit') }}" class="card-glass p-6 hover:bg-white/10 transition-colors">
                <h3 class="text-lg font-semibold mb-2">Edit Profile</h3>
                <p class="text-gray-400 text-sm">Update your account information</p>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="card-glass p-6 hover:bg-white/10 transition-colors cursor-pointer">
                @csrf
                <button type="submit" class="w-full text-left">
                    <h3 class="text-lg font-semibold mb-2">Log Out</h3>
                    <p class="text-gray-400 text-sm">Sign out of your account</p>
                </button>
            </form>
        </div>
    </div>
</x-layout.app>
