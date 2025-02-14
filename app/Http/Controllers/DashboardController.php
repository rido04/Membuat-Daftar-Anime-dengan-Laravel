<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik
        $totalWishlist = Wishlist::count();
        $totalUsers = User::count();

        return view('dashboard', [
            'totalWishlist' => $totalWishlist,
            'totalUsers' => $totalUsers
        ]);
    }
}
