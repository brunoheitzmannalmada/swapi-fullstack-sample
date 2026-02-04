<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\SearchLog;
use App\Events\SearchPerformed;

class StarWarsController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->query('search');

        if (!$search) {
            return response()->json([
                'error' => 'Search parameter is required'
            ], 400);
        }

        $response = Http::get('https://swapi.tech/api/people?page=1&limit=100');

        if (!$response->successful()) {
            return response()->json([
                'error' => 'Failed to fetch data from SWAPI'
            ], 502);
        }

        $results = collect($response->json('results'));

        $filtered = $results->filter(function ($item) use ($search) {
            return str_contains(
                strtolower($item['name']),
                strtolower($search)
            );
        })->values();

        SearchLog::create([
            'endpoint' => 'people',
            'query' => $search
        ]);

        event(new SearchPerformed($search));

        return response()->json([
            'count' => $filtered->count(),
            'results' => $filtered
        ]);
    }

    public function details(string $id)
    {
        $response = Http::get("https://swapi.tech/api/people/{$id}");

        if (!$response->successful()) {
            return response()->json([
                'error' => 'Failed to fetch person details'
            ], 502);
        }

        $person = $response->json('result.properties');

        $filmsUrls = $person['films'] ?? [];

        $films = collect($filmsUrls)
            ->map(function ($url) {
                $filmResponse = Http::get($url);

                if (!$filmResponse->successful()) {
                    return null;
                }

                return $filmResponse->json('result.properties.title');
            })
            ->filter()
            ->values();

        return response()->json([
            'id' => $id,
            'details' => [
                'name' => $person['name'],
                'birth_year' => $person['birth_year'],
                'gender' => $person['gender'],
                'eye_color' => $person['eye_color'],
                'hair_color' => $person['hair_color'],
                'height' => $person['height'],
                'mass' => $person['mass'],
                'films' => $films
            ]
        ]);
    }
}
