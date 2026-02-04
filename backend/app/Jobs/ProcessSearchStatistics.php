<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\SearchLog;
use App\Models\SearchStatistic;

class ProcessSearchStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $total = SearchLog::count();

        if ($total === 0) {
            return;
        }

        $topQueries = SearchLog::selectRaw('query, COUNT(*) as count')
            ->groupBy('query')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->map(function ($item) use ($total) {
                return [
                    'query' => $item->query,
                    'count' => $item->count,
                    'percentage' => round(($item->count / $total) * 100, 2)
                ];
            })
            ->values();

        SearchStatistic::create([
            'total_searches' => $total,
            'top_queries' => $topQueries
        ]);
    }
}
