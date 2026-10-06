<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Berlin Pfand locations</h1>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-5 px-4 py-8 sm:px-6 lg:px-8">
        @auth
            <p class="text-gray-700">Welcome, {{ auth()->user()->name }}. Find a place to return your bottles or add one you know.</p>
        @else
            <p class="text-gray-700">Browse nearby bottle return locations. <a class="text-blue-700 underline" href="{{ route('login') }}">Log in</a> to add a location.</p>
        @endauth

        @forelse ($locations as $location)
            <article class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold"><a class="text-blue-700 hover:underline" href="{{ route('locations.show', $location) }}">{{ $location->name }}</a></h2>
                <p class="mt-2 text-gray-700"><strong>Address:</strong> {{ $location->address }}</p>
                <p class="mt-1 text-gray-700">{{ $location->description ?: 'No description provided.' }}</p>
                <p class="mt-2 text-sm text-gray-500">Added by {{ $location->user->name }} · {{ $location->comments->count() }} reviews</p>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <div class="mt-4 flex gap-4">
                            <a class="text-blue-700 underline" href="{{ route('locations.edit', $location) }}">Edit</a>
                            <form action="{{ route('locations.destroy', $location) }}" method="POST" onsubmit="return confirm('Delete this location?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-700 underline" type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </article>
        @empty
            <p class="rounded-lg bg-white p-6 text-gray-700">No locations have been added yet.</p>
        @endforelse
    </div>
</x-app-layout>
