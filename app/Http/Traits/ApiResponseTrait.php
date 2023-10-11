<?php

namespace App\Http\Traits;

use App\Http\Resources\CategoriesResource;

trait ApiResponseTrait
{
    public function apiResponse($data,$message,$status){

        $array = [
            'data' =>$data,
            'meassge' =>$message,
            'status' =>$status,

        ];

        return response()->json($array,$status);
    }
}
