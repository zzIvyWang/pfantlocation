<form action="{{ $action }}" method="POST" class="space-y-5 rounded-lg bg-white p-6 shadow-sm">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label class="mb-1 block font-medium text-gray-700" for="name">Name</label>
        <input class="w-full rounded-md border-gray-300" id="name" name="name" type="text" value="{{ old('name', $location?->name) }}" required maxlength="255">
        @error('name') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-1 block font-medium text-gray-700" for="address">Address</label>
        <input class="w-full rounded-md border-gray-300" id="address" name="address" type="text" value="{{ old('address', $location?->address) }}" required maxlength="255">
        @error('address') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label class="mb-1 block font-medium text-gray-700" for="latitude">Latitude</label>
            <input class="w-full rounded-md border-gray-300" id="latitude" name="latitude" type="number" step="any" min="-90" max="90" value="{{ old('latitude', $location?->latitude) }}" required>
            @error('latitude') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="mb-1 block font-medium text-gray-700" for="longitude">Longitude</label>
            <input class="w-full rounded-md border-gray-300" id="longitude" name="longitude" type="number" step="any" min="-180" max="180" value="{{ old('longitude', $location?->longitude) }}" required>
            @error('longitude') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="mb-1 block font-medium text-gray-700" for="description">Description</label>
        <textarea class="w-full rounded-md border-gray-300" id="description" name="description" rows="4" maxlength="5000">{{ old('description', $location?->description) }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div class="flex items-center gap-4">
        <button class="rounded-md bg-blue-700 px-4 py-2 font-medium text-white hover:bg-blue-800" type="submit">{{ $buttonText }}</button>
        <a class="text-gray-700 underline" href="{{ route('locations.index') }}">Cancel</a>
    </div>
</form>
