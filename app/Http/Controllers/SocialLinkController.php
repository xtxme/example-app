<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = Auth::user()->socialLinks()->latest()->get();
        return view('social_links.index', compact('links'));
    }

    public function create()
    {
        return view('social_links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => [
                'required','string','max:100',
                Rule::unique('social_links')->where('user_id', Auth::id()),
            ],
            'url' => ['required','url','max:255'],
        ]);

        Auth::user()->socialLinks()->create($validated);

        return redirect()->route('social-links.index')
            ->with('status', 'Link added successfully!');
    }

    public function edit(string $id)
    {
        $link = Auth::user()->socialLinks()->findOrFail($id);
        return view('social_links.edit', compact('link'));
    }

    public function update(Request $request, string $id)
    {
        $link = Auth::user()->socialLinks()->findOrFail($id);

        $validated = $request->validate([
            'platform' => [
                'required','string','max:100',
                Rule::unique('social_links')->where('user_id', Auth::id())->ignore($link->id),
            ],
            'url' => ['required','url','max:255'],
        ]);

        $link->update($validated);

        return redirect()->route('social-links.index')
            ->with('status', 'Link updated successfully!');
    }

    public function destroy(string $id)
    {
        $link = Auth::user()->socialLinks()->findOrFail($id);
        $link->delete();

        return redirect()->route('social-links.index')
            ->with('status', 'Link deleted successfully!');
    }
}

