<?php

namespace App\Repositories\Admin\WareHouses;

use App\Models\Provider;

class ProviderRepository
{
    protected $provider;
    protected int $paginate = 10;

    public function getAllProvider($request)
    {
        //        dd($request);
        $data = Provider::query()
//            ->sort($request)
//            ->search($request)
//            ->filter($request)
            ->paginate($this->paginate);
        return $data;
    }

}


