<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pfand Location Checker</title>
</head>
<body>

<h1>🍾 Pfand Location System (Model Test)</h1>
<hr>

@forelse ($locations as $location)
    <div style="border: 1px solid #000; padding: 10px; margin-bottom: 15px;">
        <h2>Pfand Station: {{ $location->name }}</h2>
        <p><strong>Description:</strong> {{ $location->description }}</p>
        <p><strong>Coordinates:</strong> Lat {{ $location->latitude }}, Lng {{ $location->longitude }}</p>
        <p><strong>Reported by User:</strong> {{ $location->user->name ?? 'Unknown' }} (ID: {{ $location->user_id }})</p>

        <hr>
        <h3>Comments / Reports ({{ $location->comments->count() }})</h3>

        @if ($location->comments->isNotEmpty())
            <ul>
                @foreach ($location->comments as $comment)
                    <li>
                        <strong>{{ $comment->user->name ?? 'User #'.$comment->user_id }}:</strong>
                        {{ $comment->content }}
                        <small>({{ $comment->created_at->diffForHumans() }})</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p><em>No comments/reports for this Pfand location yet.</em></p>
        @endif
    </div>
@empty
    <p>No Pfand locations found in database.</p>
@endforelse

</body>
</html>
