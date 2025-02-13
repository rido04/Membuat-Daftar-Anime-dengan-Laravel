<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anime_id' => 'required',
            'title' => 'required',
        ]);

        Wishlist::create([
            'user_id' => Auth::id(),
            'anime_id' => $request->anime_id,
            'title' => $request->title,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Anime berhasil ditambahkan ke wishlist.');
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('success', 'Anime berhasil dihapus dari wishlist.');
    }
}
