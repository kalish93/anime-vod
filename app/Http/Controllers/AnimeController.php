<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AnimeController extends Controller
{
    /**
     * Get anime by slug and language.
     *
     * @param  string  $slug
     * @param  string  $lang
     * @return \Illuminate\Http\Response
     */
    public function getAnimeBySlugAndLang($slug, Request $request)
    {
        $lang = $request->query('lang', 'en'); // Default to English if not provided

        // Check if the slug exists for the requested language in the database
        $anime = Anime::where('titles->' . $lang . '->slug', $slug)->first();

        // If anime not found or the slug is not valid for the requested language
        if (!$anime) {
            return Response::json(['message' => 'Anime not found or language mismatch.'], 404);
        }

        // Return the anime data
        return response()->json([
            'anime' => $anime
        ], 200);
    }
}
