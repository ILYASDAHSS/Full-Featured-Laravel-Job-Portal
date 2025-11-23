@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-8 border border-gray-200 max-w-md mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Register</h1>

    <form action="{{ route('register') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Name *</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="John Doe"
                required
            />
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email *</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="john@example.com"
                required
            />
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password *</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="Enter your password"
                required
            />
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password *</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="Confirm your password"
                required
            />
        </div>

        <div class="flex items-center justify-between">
            <a href="/" class="text-gray-600 hover:text-gray-900 font-semibold">Cancel</a>
            <button
                type="submit"
                class="inline-flex items-center bg-laravel text-white font-semibold px-6 py-3 rounded-lg hover:bg-red-600 transition"
            >
                <i class="fa-solid fa-user-plus mr-2"></i> Register
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-laravel hover:text-red-600 font-semibold">Login</a>
            </p>
        </div>
    </form>
</div>
@endsection

