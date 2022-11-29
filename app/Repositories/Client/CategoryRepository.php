<?php

namespace App\Repositories\Client;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
        parent::__construct($category);
    }


    public function getAll($search = [])
    {

        return $this->category->search($search['key'])
            ->sort($search['sort_id'])->get();
    }
}