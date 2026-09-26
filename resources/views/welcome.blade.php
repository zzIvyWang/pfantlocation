<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pfand Location Finder</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
        .card { background: white; padding: 15px; margin-bottom: 15px; border-radius: 8px; }
        .comment { background: #eef; padding: 8px; margin-top: 5px; border-radius: 4px; }
    </style>
</head>
<body>
<h1>📍 Berlin Pfand Location Finder</h1>

@php
    $locations = \App\Models\Location::with('comments.user')->get();
@endphp

@foreach($locations as $location)
    <div class="card">
        <h2>{{ $location->name }}</h2>
        <p><strong>Address:</strong> {{ $location->address }}</p>
        <p>{{ $location->description }}</p>

        <h3>Comments & Ratings:</h3>
        @foreach($location->comments as $comment)
            <div class="comment">
                <p>⭐ {{ $comment->rating }}/5 — {{ $comment->content }}</p>
                <small>By: {{ $comment->user->name }}</small>
            </div>
        @endforeach
    </div>
@endforeach
</body>
</html>
