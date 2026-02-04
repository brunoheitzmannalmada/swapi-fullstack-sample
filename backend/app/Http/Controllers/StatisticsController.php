<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SearchStatistic;

class StatisticsController extends Controller
{
    public function index()
    {
        $latest = SearchStatistic::orderByDesc('created_at')->first();

        if (!$latest) {
            return response()->json([
                'message' => 'No statistics available yet'
            ], 404);
        }

        return response()->json($latest);
    }
}
