<?php

namespace App\Http\Controllers;

use App\Http\structure\Helpers\ResponseHelper;
use App\Http\structure\Repositories\OrdenDetalleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdenDetalleController extends Controller
{
    public function addOrdenDetalle(Request $request){
        $validator = Validator::make($request->all(), [
            'orden_id' => 'required|int',
            'libro_id' => 'required|int',
            'cantidad' => 'required|int',
            'precio' => 'required|numeric',
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }

        $response = OrdenDetalleRepository::addOrdenDetalle($request);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array());
    }

    public function updateOrdenDetalle(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'orden_id' => 'required|int',
            'libro_id' => 'required|int',
            'cantidad' => 'required|int',
            'precio' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = OrdenDetalleRepository::updateOrdenDetalle($request, $id);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "OrdenDetalle actualizada correctamente");
    }
}
