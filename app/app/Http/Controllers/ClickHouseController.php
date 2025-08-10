<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Services\ClickHouseService;

class ClickHouseController extends Controller
{
    public function __construct(
        private readonly ClickHouseService $clickHouseService,
    )
    {}

    public function saveData()
    {
        // TODO Вынести в расписание
        $statistics = Statistic::query()->get();
        $values = [];
        $columns = ['id', 'method', 'url', 'ip', 'full_link', 'short_link', 'created_at'];

        foreach ($statistics as $statistic) {
            $values[] = [
                $statistic->id,
                $statistic->method,
                $statistic->url,
                $statistic->ip,
                $statistic->full_link,
                $statistic->short_link,
                $statistic->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $this->clickHouseService->insert('statistics', $values, $columns);

        Statistic::query()->delete();
    }
}
