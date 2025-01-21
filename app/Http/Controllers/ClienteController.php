<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\structure\Helpers\ResponseHelper;
use App\Http\structure\Repositories\ClienteRepository;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function getClientes(){
        $response = ClienteRepository::getAllClientes();
        if ($response->isEmpty()) {
            return (object) ResponseHelper::json_success(array(), "No se encontraron productos");
        }
        return (object) ResponseHelper::json_success($response, "Clientes obtenidos exitosamente!");
    }

    public function getCliente($id){
        $response = ClienteRepository::getCliente($id);
        if(!$response){
            return (object) ResponseHelper::json_success(array(), "No se encontro producto");
        }
        return (object) ResponseHelper::json_success($response, "Cliente obtenido exitosamente!");
    }

    public function addCliente(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo_documento' => 'required|int',
            'nro_documento' => 'required|max:20|int',
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'telefono' => 'max:20',
            'email' => 'max:50|email',
        ]);
        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = ClienteRepository::addCliente($request);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Cliente registrado correctamente");
    }

    public function updateCliente($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo_documento' => 'required|int',
            'nro_documento' => 'required|max:20|int',
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'telefono' => 'max:20',
            'email' => 'max:50|email',
        ]);
        if ($validator->fails()) {
            return (object) ResponseHelper::json_fail_puts($validator);
        }
        $response = ClienteRepository::updateCliente($id, $request);
        if(!$response){
            return (object) ResponseHelper::json_failnoV($validator);
        }
        return (object) ResponseHelper::json_success(array(), "Cliente actualizado correctamente");
    }

    public function deleteCliente($id)
    {
        $response = ClienteRepository::deleteCliente($id);
        if(!$response){
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Cliente eliminado correctamente");
    }
}
