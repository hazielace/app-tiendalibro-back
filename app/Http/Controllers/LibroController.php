<?php

namespace App\Http\Controllers;
use App\Http\structure\Repositories\LibroRepository;
use App\Http\structure\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    // public function getLibros()
    // {
    //     $response = LibroRepository::getAllLibros();
    //     if ($response->isEmpty()) {
    //         return (object) ResponseHelper::json_success(array(), "No se encontraron productos");
    //     }
    //     return (object) ResponseHelper::json_success($response, "Libros obtenidos exitosamente!");
    // }

    public function getLibros(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'param' => 'nullable|string'
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }
        $response = LibroRepository::getAllSearchLibro($request);
        return (object) ResponseHelper::json_success($response);
    }

    public function getLibro($id)
    {
        $response = LibroRepository::getLibro($id);
        if(!$response){
            return (object) ResponseHelper::json_success(array(), "No se encontro producto");
        }
        return (object) ResponseHelper::json_success($response, "Libro obtenido exitosamente!");
    }

    public function addLibro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|max:20',
            'nombre' => 'required|string|max:50',
            'stock' => 'required|int',
            'precio_actual' => 'required|numeric',
        ]);

        if($validator->fails()){
            return (object) ResponseHelper::json_fail($validator);
        }

        $response = LibroRepository::addLibro($request);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Libro registrado correctamente");
    }

    public function updateLibro($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|max:20',
            'nombre' => 'required|string|max:50',
            'stock' => 'required|int',
            'precio_actual' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return (object) ResponseHelper::json_fail_puts($validator);
        }

        $response = LibroRepository::updateLibro($id, $request);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Libro actualizado correctamente");
    }

    public function deleteLibro($id)
    {
        $response = LibroRepository::deleteLibro($id);
        if (!$response) {
            return (object) ResponseHelper::json_failnoV($response);
        }
        return (object) ResponseHelper::json_success(array(), "Libro eliminado correctamente");
    }
}
