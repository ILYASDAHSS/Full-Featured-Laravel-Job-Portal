@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Job Listing</h1>

    <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Job Title *</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $listing->title) }}"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="Senior Laravel Developer"
                required
            />
            @error('title')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="company" class="block text-sm font-semibold text-gray-700 mb-1">Company *</label>
                <input
                    type="text"
                    id="company"
                    name="company"
                    value="{{ old('company', $listing->company) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                    placeholder="Acme Corp"
                    required
                />
                @error('company')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-1">Location *</label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location', $listing->location) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                    placeholder="Boston, MA"
                    required
                />
                @error('location')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Contact Email *</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $listing->email) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                    placeholder="hr@acme.com"
                    required
                />
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="website" class="block text-sm font-semibold text-gray-700 mb-1">Website</label>
                <input
                    type="url"
                    id="website"
                    name="website"
                    value="{{ old('website', $listing->website) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                    placeholder="https://www.acme.com"
                />
                @error('website')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="tags" class="block text-sm font-semibold text-gray-700 mb-1">Tags *</label>
            <input
                type="text"
                id="tags"
                name="tags"
                value="{{ old('tags', $listing->tags) }}"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="laravel, php, api"
                required
            />
            @error('tags')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-1">Company Logo</label>
            @if($listing->logo)
                <div class="mb-2">
                    <p class="text-sm text-gray-600 mb-2">Current Logo:</p>
                    <img 
                        src="{{ asset('storage/' . $listing->logo) }}" 
                        alt="{{ $listing->company }} logo" 
                        class="w-32 h-32 object-contain rounded-lg border border-gray-200 mb-2"
                    />
                </div>
            @endif
            <input
                type="file"
                id="logo"
                name="logo"
                accept="image/*"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-laravel file:text-white hover:file:bg-red-600"
            />
            <p class="text-xs text-gray-500 mt-1">Leave empty to keep current logo</p>
            @error('logo')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Job Description *</label>
            <textarea
                id="description"
                name="description"
                rows="6"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-laravel focus:ring focus:ring-laravel/20"
                placeholder="Describe responsibilities, qualifications, and perks..."
                required
            >{{ old('description', $listing->description) }}</textarea>
            @error('description')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('listings.show', $listing->id) }}" class="text-gray-600 hover:text-gray-900 font-semibold">Cancel</a>
            <button
                type="submit"
                class="inline-flex items-center bg-laravel text-white font-semibold px-6 py-3 rounded-lg hover:bg-red-600 transition"
            >
                <i class="fa-solid fa-save mr-2"></i> Update Job
            </button>
        </div>
    </form>
</div>
@endsection

