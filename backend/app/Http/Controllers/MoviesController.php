<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $response = Http::get('https://swapi.tech/api/films');

        if (!$response->successful()) {
            return response()->json([
                'error' => 'Failed to fetch data from SWAPI'
            ], 502);
        }

        $results = collect($response->json('result'));

        if (!$search) {
            return response()->json([
                'count' => $results->count(),
                'results' => $results
            ]);
        }
        
        $search = strtolower($search);

        $filtered = $results->filter(function ($item) use ($search) {
            $title = data_get($item, 'properties.title', '');

            return str_contains(
                strtolower($title),
                $search
            );
        })->values();

        return response()->json([
            'count' => $filtered->count(),
            'results' => $filtered
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get("https://swapi.tech/api/films/{$id}");

        if (!$response->successful()) {
            return response()->json([
                'error' => 'Failed to fetch person details'
            ], 502);
        }

        $movie = $response->json('result.properties');

        $charactersUrls = $movie['characters'] ?? [];

        $characters = collect($charactersUrls)
            ->map(function ($url) {
                $charResponse = Http::get($url);

                if (!$charResponse->successful()) {
                    return null;
                }

                return $charResponse->json('result.properties.name');
            })
            ->filter()
            ->values();

        return response()->json([
            'id' => $id,
            'details' => [
                'title'         => $movie['title'],
                'episode_id'    => $movie['episode_id'],
                'director'      => $movie['director'],
                'producer'      => $movie['producer'],
                'release_date'  => $movie['release_date'],
                'opening_crawl' => $movie['opening_crawl'],
                'characters'    => $characters
            ]
        ]);
    }
}
