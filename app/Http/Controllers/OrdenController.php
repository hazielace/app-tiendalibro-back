<?php

namespace App\Http\Controllers;

use App\Http\structure\Helpers\ResponseHelper;
use App\Http\structure\Repositories\ClienteRepository;
use App\Http\structure\Repositories\OrdenDetalleRepository;
use App\Http\structure\Repositories\OrdenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrdenController extends Controller
{


    public function addClienteOrden(Request $request)
    {
        DB::beginTransaction();
        try {
            $cliente = $request->input('cliente');
            if (!is_array($cliente)) {
                throw new \Exception("El campo 'cliente' no es válido");
            }

            $validatorCliente = Validator::make($cliente, [
                'tipo_documento' => 'required|int',
                'nro_documento' => 'required|numeric',
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'telefono' => 'nullable|string|max:20',
                'email' => 'nullable|string|max:50|email',
            ]);

            if ($validatorCliente->fails()) {
                return ResponseHelper::json_fail($validatorCliente);
            }

            $clienteObject = (object) $cliente;
            $clienteId = ClienteRepository::addCliente($clienteObject);

            $validatorOrden = Validator::make($request->all(), [
                'total' => 'required|numeric',
                'tipo_documento_ord' => 'required|int',
            ]);
    
            if ($validatorOrden->fails()) {
                DB::rollBack();
                return (object) ResponseHelper::json_fail($validatorOrden);
            }
    
            $request->merge(['cliente_id' => $clienteId]);
            $orden = OrdenRepository::addOrden($request);
    
            $validatorDetalles = Validator::make($request->input('detalles'), [
                '*.libro_id' => 'required|numeric',
                '*.cantidad' => 'required|numeric',
                '*.precio' => 'required|numeric',
            ]);
    
            if ($validatorDetalles->fails()) {
                DB::rollBack();
                return (object) ResponseHelper::json_fail($validatorDetalles);
            }
    
            foreach ($request->input('detalles') as $detalle) {
                $detalle['orden_id'] = $orden->order_id;
                OrdenDetalleRepository::addOrdenDetalle((object) $detalle);
            }
    
            DB::commit();
            return (object) ResponseHelper::json_success([], "Orden registrada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return (object) ResponseHelper::json_failnoV($e->getMessage());
        }
    }
    


    public function getOrdenes()
    {
        $response = OrdenRepository::getAllOrdenes();
        if ($response->isEmpty()) {
            return (object) ResponseHelper::json_success(array(), "No se encontraron ordenes");
        }
        return (object) ResponseHelper::json_success($response, "Ordenes obtenidas exitosamente!");
    }

    public function getOrden($id)
    {
        $response = OrdenRepository::getOrden($id);
        if(!$response){
            return (object) ResponseHelper::json_success(array(), "No se encontro orden");
        }
        return (object) ResponseHelper::json_success($response, "Orden obtenida exitosamente!");
    }

    public function addOrden(Request $request){
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|int',
            'total' => 'required|numeric',
            'tipo_documento' => 'required|int',
            'nro_documento' => 'required|max:20|int',
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }

        $response = OrdenRepository::addOrden($request);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Orden registrada correctamente");
    }

    public function updateOrden($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|int',
            'total' => 'required|numeric',
            'tipo_documento' => 'required|int',
            'nro_documento' => 'required|max:20|int',
        ]);

        if ($validator->fails()) {
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = OrdenRepository::updateOrden($id, $request);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Orden actualizada correctamente");
    }

    public function deleteOrden($id)
    {
        $response = OrdenRepository::deleteOrden($id);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Orden eliminada correctamente");
    }
}
