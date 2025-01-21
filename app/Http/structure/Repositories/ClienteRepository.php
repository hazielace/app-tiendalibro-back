<?php

namespace App\Http\structure\Repositories;

use App\Models\Cliente;

class ClienteRepository
{

    public static function getAllClientes()
    {
        return Cliente::all();
    }

    public static function getCliente($id)
    {
        $cliente = Cliente::where('client_id','=', $id)->first();
        return $cliente ? $cliente : [];
    }

    public static function addCliente($request)
    {
        $cliente = new Cliente();
        $cliente->doc_type = $request->tipo_documento;
        $cliente->doc_number = $request->nro_documento;
        $cliente->first_name = $request->nombre;
        $cliente->last_name = $request->apellido;
        $cliente->phone = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
        $lastInsertId = $cliente->client_id;
        return $lastInsertId;
    }

    public static function updateCliente($id, $request)
    {
        $cliente = Cliente::where('client_id','=', $id)->first();
        $cliente->doc_type = $request->tipo_documento;
        $cliente->doc_number = $request->nro_documento;
        $cliente->first_name = $request->nombre;
        $cliente->last_name = $request->apellido;
        $cliente->phone = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
        return $cliente;
    }

    public static function deleteCliente($id)
    {
        $cliente = Cliente::where('client_id','=', $id)->first();
        $cliente->delete();
        return $cliente;
    }
}