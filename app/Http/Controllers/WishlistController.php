<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {
        // Cek apakah anime sudah ada di wishlist
        $existing = Wishlist::where('anime_id', $request->anime_id)
                            ->where('user_id', Auth::id())
                            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anime sudah ada di wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'anime_id' => $request->anime_id,
            'title' => $request->title,
            'anime_image' => $request->image_url
        ]);

        return redirect()->back()->with('success', 'Anime ditambahkan ke wishlist!');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        if ($wishlist->user_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $wishlist->delete();
        return redirect()->route('wishlist.index')->with('success', 'Anime dihapus dari wishlist.');
    }
}
