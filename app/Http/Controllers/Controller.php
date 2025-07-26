<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function validing($request, $items)
    {
        $validate = Validator::make($request, $items);
        if ($validate->fails()) {
            return "Validasi gagal, periksa kembali data yang anda masukan !";
        } else {
            return null;
        }
    }

    public function successList($message,  $data, $property, $notification = null, $filter = null, $searchby = null, $other = null)
    {
        return response()->json([
            'message' => $message,
            'property' => $data->perPage() == 1000 ? null : [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage()
            ],
            'column' => $property,
            'data' => $data->getCollection(),
            'notification' => $notification,
            'filter' => $filter,
            'searchby' => $searchby,
            'other' => $other
        ]);
    }

    public function resSuccess($data, $notification = null)
    {
        return response()->json([
            'error_code' => 0,
            'error_message' => "",
            'data' => $data,
            'notification' => $notification,
        ]);
    }

    public function resFailure($code, $error, $notification = null)
    {
        if (is_array($error)) {
            $error = implode(",", $error);
        }
        return response()->json([
            'error_code' => $code,
            'error_message' => $error,
            'notification' => $notification,
        ]);
    }
}
