<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_dapat_menambahkan_anime_ke_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('wishlist.store'), [
            'anime_id' => 1,
            'title' => 'Naruto',
            'image_url' => 'https://example.com/naruto.jpg'
        ]);

        $response->assertRedirect(route('wishlist.index'));
        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'anime_id' => 1,
            'title' => 'Naruto'
        ]);
    }

    /** @test */
    public function user_dapat_menghapus_anime_dari_wishlist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $wishlist = Wishlist::create([
            'user_id' => $user->id,
            'anime_id' => 1,
            'title' => 'Naruto',
            'image_url' => 'https://example.com/naruto.jpg'
        ]);

        $response = $this->delete(route('wishlist.destroy', $wishlist));
        $response->assertRedirect(route('wishlist.index'));
        $this->assertDatabaseMissing('wishlists', ['id' => $wishlist->id]);
    }
}
