<?php

namespace App\Services;

use App\Models\Rating;

/**
 * Class RatingService.
 *
 * @property Rating $model
 */
class RatingService extends BaseService
{
    public function __construct(Rating $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function ratingBreakdown($rateableId, $rateableType)
    {
        $data = [];


        $type = \TinhPHP\School\Models\Rating::type();

        foreach ($type as $idType => $textType) {
            $totalSum = Rating::query()
                ->where('rateable_type', $rateableType)
                ->where('rateable_id', $rateableId)
                ->where('type', $idType)
                ->where('rating', '>', 0)
                ->sum('rating');

            $totalAllItem = Rating::query()
                ->where('rateable_type', $rateableType)
                ->where('rateable_id', $rateableId)
                ->where('type', $idType)
                ->where('rating', '>', 0)
                ->count();

            $data[$idType] = [
                'count' => $totalAllItem,
                'avg' => $totalAllItem > 0 ? round($totalSum / $totalAllItem, 1) : 0,
            ];
        }

        return $data;
    }
}
