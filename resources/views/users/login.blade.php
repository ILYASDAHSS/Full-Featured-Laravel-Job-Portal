@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-8 border border-gray-200 max-w-md mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Login</h1>

    <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf

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

        <div class="flex items-center justify-between">
            <a href="/" class="text-gray-600 hover:text-gray-900 font-semibold">Cancel</a>
            <button
                type="submit"
                class="inline-flex items-center bg-laravel text-white font-semibold px-6 py-3 rounded-lg hover:bg-red-600 transition"
            >
                <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Login
            </button>
        </div>

        <div class="text-center mt-4 space-y-2">
            <p class="text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-laravel hover:text-red-600 font-semibold">Register</a>
            </p>
            <p class="text-gray-600">
                <a href="{{ route('password.request') }}" class="text-laravel hover:text-red-600 font-semibold">Forgot Password?</a>
            </p>
        </div>
    </form>
</div>
@endsection

