<?php

namespace App\Http\structure\Repositories;

use App\Models\Orden;

class OrdenRepository
{   
    public static function getAllOrdenes()
    {
        return Orden::all();
    }

    public static function getOrden($id)
    {
        $orden = Orden::where('order_id','=', $id)->first();
        return $orden ? [$orden] : [];
    }

    public static function addOrden($request)
    {
        $orden = new Orden();
        $orden->client_id = $request->cliente_id;
        $orden->total = $request->total;
        $orden->doc_type = $request->tipo_documento_ord;
        $tipoDocumento = (int) $request->tipo_documento_ord;
        $orden->doc_number = match ($tipoDocumento) {
            1 => str_pad(random_int(0, 999999999999), 12, '0', STR_PAD_LEFT),
            2 => str_pad(random_int(0, PHP_INT_MAX), 20, '0', STR_PAD_LEFT), 
            default => null,
        };
        $orden->created_at = now();
        $orden->save();
        return $orden;
    }
    
    public static function updateOrden($id, $request)
    {
        $orden = Orden::where('order_id','=', $id)->first();
        $orden->client_id = $request->cliente_id;
        $orden->total = $request->total;
        $orden->doc_type = $request->tipo_documento;
        $orden->doc_number = $request->nro_documento;
        $orden->created_at = date('Y-m-d H:i:s');
        $orden->save();
        return $orden;
    }

    public static function deleteOrden($id)
    {
        $orden = Orden::where('order_id','=', $id)->first();
        $orden->delete();
        return $orden;
    }
}