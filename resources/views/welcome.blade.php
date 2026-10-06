<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Welcome to Berlin Pfand Finder</h1>
    </x-slot>

    <main class="mx-auto flex min-h-[70vh] max-w-5xl flex-col items-center justify-center px-6 py-16 text-center">
        <p class="text-5xl" aria-hidden="true">🍾</p>
        <h2 class="mt-6 text-4xl font-bold tracking-tight text-gray-900">Find a place to return your bottles.</h2>
        <p class="mt-4 max-w-2xl text-lg text-gray-600">Browse Pfand locations around Berlin, share useful details, and leave a rating for the community.</p>

        <a class="mt-8 rounded-md bg-blue-700 px-6 py-3 font-semibold text-white hover:bg-blue-800" href="{{ route('locations.index') }}">Browse locations</a>

        <div class="mt-auto pt-16">
            @guest
                <p class="mb-3 text-gray-600">Log in to add locations and comments.</p>
                <a class="inline-block rounded-md border border-blue-700 px-6 py-3 font-semibold text-blue-700 hover:bg-blue-50" href="{{ route('login') }}">Log in</a>
                <a class="ml-3 inline-block px-4 py-3 font-semibold text-gray-700 underline" href="{{ route('register') }}">Create an account</a>
            @else
                <p class="mb-3 text-gray-600">Signed in as {{ auth()->user()->name }}.</p>
                <a class="inline-block rounded-md border border-blue-700 px-6 py-3 font-semibold text-blue-700 hover:bg-blue-50" href="{{ route('locations.create') }}">Add a location</a>
            @endguest
        </div>
    </main>
</x-app-layout>
