<!DOCTYPE html>
<html>
<head>
    <title>Pfand Location Finder</title>
</head>
<body>
<nav style="display: flex; gap: 15px; align-items: center; background: #eee; padding: 10px;">
    <strong>🍾 Berlin Pfand Finder</strong>
    @auth
        <span>歡迎, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
        <a href="{{ route('locations.create') }}">+ 新增地點</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">登出</button>
        </form>
    @else
        <a href="{{ route('login') }}">Log in</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
</nav>

<main style="padding: 20px;">
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h1>📍 Location List</h1>

    @forelse($locations as $location)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
            <h2>
                <a href="{{ route('locations.show', $location) }}">{{ $location->name }}</a>
            </h2>
            <p><strong>Address:</strong> {{ $location->address }}</p>
            <p><strong>Description:</strong> {{ $location->description }}</p>

            @auth
                <div>
                    <a href="{{ route('locations.edit', $location) }}">編輯</a>
                    <form action="{{ route('locations.destroy', $location) }}" method="POST" style="display: inline;" onsubmit="return confirm('確定刪除？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red;">刪除</button>
                    </form>
                </div>
            @endauth

            <h4>💬 Comments ({{ $location->comments->count() }})</h4>
            <ul>
                @forelse($location->comments as $comment)
                    <li>
                        <strong>Rating: {{ $comment->rating }}/5</strong> - {{ $comment->content }} (by {{ $comment->user->name }})
                    </li>
                @empty
                    <li>No comments yet.</li>
                @endforelse
            </ul>
        </div>
    @empty
        <p>No locations found.</p>
    @endforelse
</main>
</body>
</html>
