<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateFcmController extends Controller
{
    public function __invoke(Request $request)
    {
        if(auth()->check()){
            auth()->user()->update([
                'fcm_token' => $request->fcm_token
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Fcm token has been updated',
                'fcm_token'=>$request->fcm_token,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);

    }
}
