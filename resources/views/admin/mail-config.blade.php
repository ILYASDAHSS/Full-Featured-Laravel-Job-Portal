@extends('layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">SMTP / Mail Configuration</h2>

    @if (session('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">{{ session('message') }}</div>
    @endif
    @if (session('warning'))
        <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg">{{ session('warning') }}</div>
    @endif

    <form method="POST" action="{{ url('admin/mail-config') }}">
        @csrf

        <div class="grid grid-cols-1 gap-4">
            <label class="block">
                <span class="text-gray-700">Mailer</span>
                <input name="mail_mailer" value="{{ old('mail_mailer', env('MAIL_MAILER', 'smtp')) }}" class="mt-1 block w-full" />
            </label>

            <label class="block">
                <span class="text-gray-700">Host</span>
                <input name="mail_host" value="{{ old('mail_host', env('MAIL_HOST')) }}" class="mt-1 block w-full" />
            </label>

            <label class="block">
                <span class="text-gray-700">Port</span>
                <input name="mail_port" value="{{ old('mail_port', env('MAIL_PORT')) }}" class="mt-1 block w-full" />
            </label>

            <label class="block">
                <span class="text-gray-700">Username</span>
                <input name="mail_username" value="{{ old('mail_username', env('MAIL_USERNAME')) }}" class="mt-1 block w-full" />
            </label>

            <label class="block">
                <span class="text-gray-700">Password</span>
                <input name="mail_password" type="password" value="" class="mt-1 block w-full" placeholder="Enter app password" />
            </label>

            <label class="block">
                <span class="text-gray-700">Encryption</span>
                <input name="mail_encryption" value="{{ old('mail_encryption', env('MAIL_ENCRYPTION')) }}" class="mt-1 block w-full" />
            </label>

            <label class="block">
                <span class="text-gray-700">From address</span>
                <input name="mail_from_address" value="{{ old('mail_from_address', env('MAIL_FROM_ADDRESS')) }}" class="mt-1 block w-full" />
            </label>

            <label class="block">
                <span class="text-gray-700">From name</span>
                <input name="mail_from_name" value="{{ old('mail_from_name', env('MAIL_FROM_NAME')) }}" class="mt-1 block w-full" />
            </label>

            <div class="flex justify-end">
                <button type="submit" class="bg-laravel text-white px-4 py-2 rounded">Save & Test</button>
            </div>
        </div>
    </form>
</div>
@endsection
