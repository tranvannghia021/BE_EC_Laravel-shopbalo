<?php

namespace App\Repositories\Admin\WareHouses;

use App\Models\ExportStorage;
use App\Models\ImportStorage;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Storage;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class StorageRepository
{
    protected $storage;
    protected int $paginate = 10;

    public function getAllStorage($request)
    {
        //        dd($request);
        $data = Storage::query()
            ->with('products')
            ->with('providers')
            ->sort($request)
            ->search($request)
            //            ->filter($request)
            ->paginate($this->paginate);
        return $data;
        //        dd($data);
    }

    public function getAllImportHistory($request)
    {
        //        dd($request);
        $data = ImportStorage::query()
            ->with('products')
            ->with('providers')
            ->sort($request)
            ->search($request)
            //            ->filter($request)
            ->paginate($this->paginate);
        return $data;
    }

    public function getAllExportHistory($request)
    {
        //        dd($request);
        $data = ExportStorage::query()
            ->with('products')
            ->with('providers')
            ->sort($request)
            ->search($request)
            //            ->filter($request)
            ->paginate($this->paginate);
        return $data;
    }

    public function importStorage($request)
    {
        try {

            $storage = Storage::query()->where('product_id', '=', $request['product_id'])->first();
            $importStorage = ImportStorage::query()->create($request);
            if ($storage) {
                $storage->update([
                    'amount' => $storage['amount'] + $request['import_amount']
                ]);
            } else {
                $storage = Storage::query()->create([
                    'product_id' => $request['product_id'],
                    'provider_id' => $request['provider_id'],
                    'amount' => $request['import_amount']
                ]);
            }
        } catch (\Exception $e) {
            return false;
        }
        return ImportStorage::query()->find($importStorage['id']);
    }

    public function exportStorage($request)
    {


        $storage = Storage::query()->where('product_id', '=', $request['product_id'])->first();

        if ($storage) {
            if ($request['export_amount'] <= $storage['amount'] && $storage['amount'] > 0) {
                $dataRequest = [
                    'product_id' => $request['product_id'],
                    'provider_id' => $storage['provider_id'],
                    'name' => $request['name'],
                    'export_amount' => $request['export_amount']
                ];
                $exportStorage = ExportStorage::query()->create($dataRequest);

                $storage->update([
                    'amount' => (int)$storage['amount'] - (int)$request['export_amount']
                ]);
                $data = [
                    'status' => 'success',
                    'data' => ExportStorage::query()->find($exportStorage['id']),
                    'message' => 'Export successfully'
                ];
            } else {
                $data = [
                    'status' => 'fail',
                    'data' => [],
                    'message' => 'Export quantity is larger than existing quantity or out of stock'
                ];
            }
        } else {
            $data = [
                'status' => 'fail',
                'data' => [],
                'message' => 'The product is not in stock'
            ];
        }




        return $data;
    }

    public function statisticImportStorage($request)
    {
        $result = ImportStorage::query();
        if (env('DB_CONNECTION') == 'pgsql') {
            try {
                //select EXTRACT(MONTH  From created_at) AS month,
                //SUM( import_amount ) AS amount
                //from "import_storages" group by "month"
                $result = $result->selectRaw('EXTRACT(MONTH  From created_at) AS month')
                    ->selectRaw('SUM( import_amount ) AS amount')
                    ->groupBy('month')
                    //    ->toSql();
                    //  dd($result);
                    ->get();
            } catch (\Exception $e) {
                //  dd($e);
                return false;
            }
        } else {
            try {
                $result = $result->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(import_amount)AS amount'))
                    ->groupBy('month')
                    ->get();
            } catch (\Exception $e) {
                dd($e);
                return false;
            }
        }

        return response()->json($result)->getData();
    }

    public function statisticExportStorage($request)
    {
//        $start=$request->start;
//        $end=$request->end;
        //SELECT MONTH(created_at) as month, SUM(import_amount) as amount FROM `import_storages` WHERE 1 GROUP BY month;
        $result = ExportStorage::query();
        if (env('DB_CONNECTION') == 'pgsql') {
            try {
                //select EXTRACT(MONTH  From created_at) AS month,
                //SUM( import_amount ) AS amount
                //from "import_storages" group by "month"
                $result = $result->selectRaw('EXTRACT(MONTH  From created_at) AS month')
                    ->selectRaw('SUM( export_amount ) AS amount')
                    ->groupBy('month')
                    //    ->toSql();
                    //  dd($result);
                    ->get();
            } catch (\Exception $e) {
                //  dd($e);
                return false;
            }
        } else {
            try {
                $result = $result->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(export_amount)AS amount'))
                    ->groupBy('month')
                    ->get();
            } catch (\Exception $e) {
                dd($e);
                return false;
            }
        }

        return response()->json($result)->getData();
    }
}
