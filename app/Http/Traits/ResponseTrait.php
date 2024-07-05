<?php
namespace App\Http\Traits;

trait ResponseTrait {
    public function responseSuccess($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    public function responseError($data, $status = 400)
    {
        return response()->json($data, $status);
    }

}

?>
