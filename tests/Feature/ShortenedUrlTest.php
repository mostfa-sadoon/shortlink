<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\ShortenedUrl;
use App\Models\Analytic;

class ShortenedUrlTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_shorten_url()
    {
       

        $response = $this->post(route('shorten.store'), [
            'original_url' => 'https://www.youtube.com/watch?v=Ksw5kXt2Psc&list=RDQL1yznqLflY&index=27',
        ]);

        $response->assertStatus(200); // Ensure request is successful
        $this->assertDatabaseHas('shortened_urls', ['original_url' => 'https://www.youtube.com/watch?v=Ksw5kXt2Psc&list=RDQL1yznqLflY&index=27']);

        $shortenedUrl = ShortenedUrl::first();
        $this->assertNotNull($shortenedUrl);
        $this->assertTrue(Cache::has("shortened_url:{$shortenedUrl->short_code}"));
    }


    public function test_redirect_a_shortened_url()
    {
        $shortenedUrl = ShortenedUrl::create([
            'original_url' => 'https://www.youtube.com/watch?v=Ksw5kXt2Psc&list=RDQL1yznqLflY&index=27',
            'short_code' => 'abc123'
        ]);

        Cache::put("shortened_url:abc123", $shortenedUrl, 3600);

        $response = $this->get(route('redirect', ['short_code' => 'abc123']));

        $response->assertRedirect($shortenedUrl->original_url);
        $this->assertDatabaseHas('analytics', ['short_code' => 'abc123']);
    }


    public function test_displays_analytics()
    {
        $shortenedUrl = ShortenedUrl::create([
            'original_url' => 'https://example.com',
            'short_code' => 'xyz789'
        ]);

        Analytic::create([
            'short_code' => 'xyz789',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0'
        ]);

        $response = $this->get(route('analytics', ['short_code' => 'xyz789']));

        $response->assertStatus(200);
        $response->assertSee($shortenedUrl->original_url);
       
    }
}
