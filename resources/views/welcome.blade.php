<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pfand Location Finder</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #f0f2f5; margin: 0; padding: 0; }
        .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .nav-links a { margin-left: 15px; text-decoration: none; color: #4a5568; font-weight: 600; }
        .nav-links a:hover { color: #3182ce; }
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        h1 { color: #1a202c; text-align: center; }
        .card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card h2 { margin-top: 0; color: #2d3748; }
        .address { color: #718096; font-size: 0.95rem; }
        .desc { background: #f7fafc; padding: 10px; border-left: 4px solid #4299e1; margin: 15px 0; border-radius: 4px; }
        .comments-section { margin-top: 20px; border-top: 1px solid #edf2f7; padding-top: 15px; }
        .comment { background: #f8fafc; border: 1px solid #e2e8f0; padding: 10px 15px; border-radius: 6px; margin-top: 10px; }
        .rating { color: #e53e3e; font-weight: bold; }
        .author { font-size: 0.85rem; color: #a0aec0; text-align: right; margin-top: 5px; }
    </style>
</head>
<body>

<!-- Breeze 登入 / 註冊 導覽列 -->
<nav class="navbar">
    <div style="font-weight: bold; font-size: 1.2rem;">🍾 Pfand Finder</div>
    <div class="nav-links">
        @if (Route::has('login'))
            @auth
                <span>歡迎，{{ auth()->user()->name }}！</span>
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 15px;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #e53e3e; cursor: pointer; font-weight: 600;">登出</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<div class="container">
    <h1>📍 Berlin PfandPilot</h1>

    @foreach($locations as $location)
        <div class="card">
            <h2>{{ $location->name }}</h2>
            <div class="address">📍 {{ $location->address }}</div>
            <div class="desc">{{ $location->description }}</div>

            <div class="comments-section">
                <h3>💬 Comments ({{ $location->comments->count() }})</h3>
                @forelse($location->comments as $comment)
                    <div class="comment">
                        <span class="rating">⭐ {{ $comment->rating }} / 5</span>
                        <p style="margin: 5px 0;">{{ $comment->content }}</p>
                        <div class="author">— {{ $comment->user->name }}</div>
                    </div>
                @empty
                    <p style="color: #a0aec0;">目前尚無評論。</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
