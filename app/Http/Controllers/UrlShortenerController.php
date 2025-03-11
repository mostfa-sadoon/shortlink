<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ShortenedUrl,Analytic};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


class UrlShortenerController extends Controller
{
    //

    public function index(){
        return view('index');
    }

    public function shorten(Request $request) {
       
        $request->validate([
            'original_url' => 'required|url',
            'custom_alias' => 'nullable|string|unique:shortened_urls,short_code|max:10'
        ]);

        $short_code = $request->custom_alias ?? Str::random(6);

        $shortenedUrl = ShortenedUrl::create([
            'original_url' => $request->original_url,
            'short_code' => $short_code
        ]);


        Cache::put("shortened_url:{$short_code}", $shortenedUrl, 3600);

        return view('shortlink',compact('shortenedUrl'));
    }

    public function redirect(Request $request,$short_code) {
        
        $shortenedUrl = Cache::remember("shortened_url:{$short_code}", 3600, function () use ($short_code) {
            return ShortenedUrl::where('short_code', $short_code)->first();
        });

        $shortenedUrl->increment('clicks');

        Analytic::create([
            'short_code' => $short_code,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return redirect()->to($shortenedUrl->original_url);
    }

    public function analytics($short_code) {
        $shortenedUrl = ShortenedUrl::where('short_code', $short_code)->firstOrFail();
        $Analytics = Analytic::where('short_code', $short_code)->orderby('id','desc')->get()->take(10);
       return view('analytic',compact('shortenedUrl','Analytics'));
    }
}
