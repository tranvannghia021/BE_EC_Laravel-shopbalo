<?php

namespace App\Services\Admin\WareHouses;

use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\WareHouses\StorageRepository;

class StorageService
{

    use apiResponse;
    protected StorageRepository $storageRepository;

    public function __construct(StorageRepository $storageRepository)
    {
        $this->storageRepository = $storageRepository;
    }

    public function getAllStorage($request)
    {
        if($request->has('listimport')){
            $result = $this->storageRepository->getAllImportHistory($request);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get all import history successfully');
            } else {
                return $this->apiResponse([], 'fail', 'Get all import history unsuccessfuly');
            }
        }elseif($request->has('listexport')){

            $result = $this->storageRepository->getAllExportHistory($request);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get all export history successfully');
            } else {
                return $this->apiResponse([], 'fail', 'Get all export history unsuccessfuly');
            }
        }

        else{
            $result = $this->storageRepository->getAllStorage($request);
            if ($result) {
                return $this->apiResponse($result, 'success', 'Get all storage successfully');
            } else {
                return $this->apiResponse([], 'fail', 'Get all storage unsuccessfuly');
            }
        }


    }
    public function getAmountImport($request)
    {
        $result = $this->storageRepository->statisticImportStorage($request);
        $data=[
            'data'=>$result
        ];

        return $this->apiResponse($data, 'success', 'Figure ImportStorage successfully');
    }
    public function getAmountExport($request)
    {
        $result = $this->storageRepository->statisticExportStorage($request);
        $data=[
            'data'=>$result
        ];

        return $this->apiResponse($data, 'success', 'Figure ExportStorage successfully');
    }

    public function importStorage($request){
        $dataRequest = [
            'product_id' => $request->product_id,
            'provider_id' => $request->provider_id,
            'name' => $request->name,
            'import_amount'=>$request->import_amount
        ];
//        dd($dataRequest);
        $result = $this->storageRepository->importStorage($dataRequest);
        if ($result) {
            return $this->apiResponse($result, 'success', 'Import storage successfully');
        } else {
            return $this->apiResponse([], 'fail', 'Import storage unsuccessful');
        }
    }

    public function exportStorage($request){
        $dataRequest = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'export_amount'=>$request->export_amount
        ];

        $result = $this->storageRepository->exportStorage($dataRequest);

        if ($result) {
            return $this->apiResponse($result['data'], $result['status'], $result['message']);
        } else {
            return $this->apiResponse([], 'fail', 'export storage unsuccessful');
        }
    }
}
