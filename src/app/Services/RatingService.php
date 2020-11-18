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

        $totalAll = Rating::query()
            ->where('rateable_type', $rateableType)
            ->where('rateable_id', $rateableId)
            ->count();
        for ($i = 1; $i < 6; $i++) {
            $totalAllItem = Rating::query()
                ->where('rateable_type', $rateableType)
                ->where('rateable_id', $rateableId)
                ->where('rating', $i)
                ->count();

            $data[$i] = [
                'count' => $totalAllItem,
                'percent' => $totalAllItem > 0 ? ($totalAllItem * 100) / $totalAll : 0,
            ];
        }

        return $data;
    }
}
