<?php
namespace App\Http\structure\Helpers;

class ResponseHelper{
    public static function json_fail_puts($validator,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "danger",
            "length" => 0,
            "data" => $validator->errors()->all(),
        ];
        return response()->json($data);
    }

    public static function json_fail($validator,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "danger",
            "length" => 0,
            "data" =>  $validator->errors(),
        ];
        return response()->json($data);
    }

    public static function json_failnoV($data,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "danger",
            "length" => 0,
            "data" => $data,
        ];
        return response()->json($data);
    }

    public static function json_successnoV($data,$mensaje = null)
    {
        $data = [
            "status" =>  false,
            "message" =>  (isset($mensaje)) ? $mensaje : "success",
            "length" => 0,
            "data" => $data,
        ];
        return response()->json($data);
    }


    public static function json_success($data,$mensaje = null)
    {
        $response = [
            "status" =>  true,
            "message" =>  (isset($mensaje)) ? $mensaje : "success",
            "length" => count($data),
            "data" => $data,
        ];
        return response()->json($response);
    }

    public static function json_success2($data,$mensaje = null)
    {
        $response = [
            "status" =>  true,
            "message" =>  (isset($mensaje)) ? $mensaje : "Se procedio correctamente",
            "length" => count($data),
            "data" => $data,
        ];
        return response()->json($response);
    }

}