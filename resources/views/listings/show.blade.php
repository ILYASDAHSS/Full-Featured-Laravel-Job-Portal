@extends("layout")

@section("content")
     
<h1 class="text-3xl font-bold mb-8 text-gray-800">{{ $heading }}</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach ($listings as $listing)
    <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200 hover:shadow-xl transition">
        @if($listing->logo)
            <div class="mb-4">
                <img 
                    src="{{ asset('storage/' . $listing->logo) }}" 
                    alt="{{ $listing->company }} logo" 
                    class="w-32 h-32 object-contain rounded-lg border border-gray-200 mx-auto"
                />
            </div>
        @endif
        
        <h2 class="text-xl font-semibold text-gray-900 mb-2">
            Job #{{ $listing->id }} – {{ $listing->title }}
        </h2>

        <p class="text-gray-700 mb-2">
            <strong class="text-gray-900">Company:</strong> {{ $listing->company }}
        </p>

        <p class="text-gray-700 mb-2">
            <strong class="text-gray-900">Location:</strong> {{ $listing->location }}
        </p>

        <p class="text-gray-700 mb-2">
            <strong class="text-gray-900">Salary:</strong> {{ $listing->salary }}
        </p>

        <p class="text-gray-700 mb-4">
            <strong class="text-gray-900">Description:</strong><br>
            <span class="text-sm text-gray-600">{{ Str::limit($listing->description, 120, '...') }}</span>
        </p>

        <div class="flex gap-2">
            <a 
                href="{{ route('listings.edit', $listing->id) }}"
                class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition"
            >
                <i class="fa-solid fa-pencil mr-2"></i> Edit
            </a>
            <form method="POST" action="{{ route('listings.destroy', $listing->id) }}" class="inline" id="deleteForm{{ $listing->id }}">
                @csrf
                @method('DELETE')
                <button
                    type="button"
                    class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition delete-btn"
                    data-form-id="deleteForm{{ $listing->id }}"
                    data-listing-title="{{ $listing->title }}"
                >
                    <i class="fa-solid fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endforeach

</div>

<a href="/" class="inline-block mt-8 text-blue-600 hover:text-blue-800 font-semibold">
    ← Back to all listings
</a>

@endsection
