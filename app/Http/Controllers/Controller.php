<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function response_json($status, $code, $message, $data = [], $extra_data = [])
    {
        $response = array_merge([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $extra_data);
        return response()->json($response, $code);
    }

    public function returnBackWithSaveDone(){
        return back()->with([
            'message' => 'Save Done',
            'alert-type' => 'success'
        ]);
    }

    public function returnBackWithSaveDoneFailed(){
        return back()->with([
            'message' => 'Save Failed',
            'alert-type' => 'error'
        ]);
    }
    public function invalidIntParameter()
    {
        return back()->with([
            'message' => __('something went error'),
            'alert-type' => 'error'
        ]);
    }

}
