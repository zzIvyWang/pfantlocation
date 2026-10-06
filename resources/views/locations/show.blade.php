<x-app-layout>
    <x-slot name="header"><h1 class="text-2xl font-semibold text-gray-800">{{ $location->name }}</h1></x-slot>
    <div class="mx-auto max-w-4xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <article class="rounded-lg bg-white p-6 shadow-sm">
            <p class="text-gray-700"><strong>Address:</strong> {{ $location->address }}</p>
            <p class="mt-3 text-gray-700"><strong>Coordinates:</strong> {{ $location->latitude }}, {{ $location->longitude }}</p>
            <p class="mt-3 whitespace-pre-line text-gray-700">{{ $location->description ?: 'No description provided.' }}</p>
            <p class="mt-4 text-sm text-gray-500">Added by {{ $location->user->name }}</p>
            @auth
                @if (auth()->user()->role === 'admin')
                    <a class="mt-4 inline-block text-blue-700 underline" href="{{ route('locations.edit', $location) }}">Edit this location</a>
                @endif
            @endauth
        </article>

        <section class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800">Reviews ({{ $location->comments->count() }})</h2>
            @forelse ($location->comments as $comment)
                <article class="mt-4 border-t border-gray-200 pt-4">
                    <p class="font-medium">Rating: {{ $comment->rating }}/5</p>
                    <p class="mt-1 text-gray-700">{{ $comment->content }}</p>
                    <p class="mt-1 text-sm text-gray-500">By {{ $comment->user->name }}</p>
                </article>
            @empty
                <p class="mt-3 text-gray-600">No reviews yet.</p>
            @endforelse
        </section>
        @auth
            <section class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800">Add a comment</h2>
                <form action="{{ route('comments.store', $location) }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label class="mb-1 block font-medium text-gray-700" for="rating">Rating</label>
                        <select class="w-full rounded-md border-gray-300" id="rating" name="rating" required>
                            <option value="">Choose a rating</option>
                            @foreach (range(1, 5) as $rating)
                                <option value="{{ $rating }}" @selected((string) old('rating') === (string) $rating)>{{ $rating }} / 5</option>
                            @endforeach
                        </select>
                        @error('rating') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1 block font-medium text-gray-700" for="content">Comment</label>
                        <textarea class="w-full rounded-md border-gray-300" id="content" name="content" rows="4" maxlength="2000" required>{{ old('content') }}</textarea>
                        @error('content') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
                    </div>
                    <button class="rounded-md bg-blue-700 px-4 py-2 font-medium text-white hover:bg-blue-800" type="submit">Post comment</button>
                </form>
            </section>
        @else
            <p class="rounded-lg bg-white p-6 text-gray-700"><a class="text-blue-700 underline" href="{{ route('login') }}">Log in</a> to add a comment.</p>
        @endauth
        <a class="text-blue-700 underline" href="{{ route('locations.index') }}">Back to locations</a>
    </div>
</x-app-layout>
