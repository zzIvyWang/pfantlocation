<x-app-layout>
    <x-slot name="header"><h1 class="text-2xl font-semibold text-gray-800">Edit {{ $location->name }}</h1></x-slot>
    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        @include('locations._form', ['action' => route('locations.update', $location), 'method' => 'PUT', 'buttonText' => 'Save changes'])
    </div>
</x-app-layout>
