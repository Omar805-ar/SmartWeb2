<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Validator;

trait ValidationHelper
{
    public function ValidationHelper($request, array $rules, $json = false)
    {
        if ($json == true) {

            $data = json_decode($request, $request->all());
        } else {
            $data =  $request->all();
        }
        $validateUser = Validator::make($data, $rules);
        if ($validateUser->fails()) {
            return [
                'status'    => false,
                'errors'    => $validateUser->errors()
            ];
        } else {
            return [
                'status'    => true,
                'errors'    => []
            ];
        }
    }
}
