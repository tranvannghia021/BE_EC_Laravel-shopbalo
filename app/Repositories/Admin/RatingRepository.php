<?php

namespace App\Repositories\Admin;

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


    /**
     * getAll
     * override
     *
     * @author tranvannghia021
     * @param  mixed $search
     * @return void
     */
    public function getAll($search = [])
    {
        return $this->rating->search(@$search['key'])->sortPoint($search['sortPoint'])
            ->sortStatus(@$search['sortStatus'])
            ->with(['customers', 'products'])->paginate(@$search['per_page']);
    }
}
