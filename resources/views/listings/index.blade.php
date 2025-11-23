@extends("layout")

@section("content")
<h1 class="text-3xl font-bold text-gray-900 mb-8">{{ $heading }}</h1>

<div class="space-y-6">
    @forelse ($listings as $listing)
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex flex-col gap-4">
                <div class="flex items-start gap-4">
                    @if($listing->logo)
                        <img 
                            src="{{ asset('storage/' . $listing->logo) }}" 
                            alt="{{ $listing->company }} logo" 
                            class="w-20 h-20 object-contain rounded-lg border border-gray-200"
                        />
                    @endif
                    <div class="flex-1">
                        <h3 class="text-2xl font-semibold text-gray-900">
                            <a href="{{ route('listings.show', $listing->id) }}" class="hover:text-laravel">
                                {{ $listing->title }}
                            </a>
                        </h3>
                        <p class="text-lg font-bold text-gray-700">{{ $listing->company }}</p>
                    </div>
                </div>

                <ul class="flex flex-wrap gap-2">
                @foreach (explode(',', $listing->tags) as $tag)
    <a href="/?tag={{ trim($tag) }}">
        <li class="bg-black text-white rounded-full py-1 px-3 text-xs uppercase tracking-wide hover:bg-gray-800 transition">
            {{ trim($tag) }}
        </li>
    </a>
@endforeach

                </ul>

                <div class="text-gray-600 flex flex-wrap gap-4 text-sm">
                    <span class="flex items-center">
                        <i class="fa-solid fa-location-dot text-laravel mr-2"></i>
                        {{ $listing->location }}
                    </span>
                    <span class="flex items-center">
                        <i class="fa-solid fa-envelope text-laravel mr-2"></i>
                        {{ $listing->email }}
                    </span>
                    @if ($listing->website)
                        <a href="{{ $listing->website }}" target="_blank" rel="noopener" class="flex items-center text-blue-600 hover:text-blue-800">
                            <i class="fa-solid fa-globe text-laravel mr-2"></i>
                            Website
                        </a>
                    @endif
                </div>

                <p class="text-gray-700 leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($listing->description, 160, '...') }}
                </p>

                <div class="flex justify-end gap-2">
                    <a
                        href="{{ route('listings.edit', $listing->id) }}"
                        class="inline-flex items-center bg-gray-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-gray-700 transition"
                    >
                        <i class="fa-solid fa-pencil mr-2"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('listings.destroy', $listing->id) }}" class="inline" id="deleteForm{{ $listing->id }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="button"
                            class="inline-flex items-center bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition delete-btn"
                            data-form-id="deleteForm{{ $listing->id }}"
                            data-listing-title="{{ $listing->title }}"
                        >
                            <i class="fa-solid fa-trash mr-2"></i> Delete
                        </button>
                    </form>
                    <a
                        href="{{ route('listings.show', $listing->id) }}"
                        class="inline-flex items-center bg-laravel text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-600 transition"
                    >
                        View Details
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-600">No listings found.</p>
    @endforelse
</div>
<div class="mt-5 p-4">
     {{$listings->links()}}
</div>
@endsection
