<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Location $location): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);

        $location->comments()->create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('locations.show', $location)->with('success', 'Comment added successfully.');
    }
}
