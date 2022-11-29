<?php

namespace App\Repositories\Client;

use App\Models\Rating;
use App\Repositories\BaseRepository;

class RatingRepository extends BaseRepository
{
    protected $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
        parent::__construct($rating);
    }


    public function getAll($search = [])
    {
        try {
            return $this->rating->filterProductById($search['filter'])->search(@$search['key'])->sortPoint($search['sortPoint'])
                ->sortStatus(@$search['sortStatus'])
                ->with(['customers', 'products'])->paginate(@$search['per_page']);
        }
        catch (\Exception $e) {
            dd($e);
        }
    }
}
