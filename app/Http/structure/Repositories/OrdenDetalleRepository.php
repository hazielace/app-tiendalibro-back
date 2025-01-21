<?php

namespace App\Http\structure\Repositories;
use App\Models\Libro;
use App\Models\Orden;
use App\Models\OrdenDetalle;

class OrdenDetalleRepository
{
    public static function getAllOrdenDetalles()
    {
        return OrdenDetalle::all();
    }

    // public static function getOrdenDetalle($orden_id)
    // {
    //     $ordenDetalle = OrdenDetalle::where('client','=', $id)->first();
    //     return $ordenDetalle ? $ordenDetalle : [];
    // }

    public static function addOrdenDetalle($request)
    {
        $ordenDetalle = new OrdenDetalle();
        $ordenDetalle->order_id = $request->orden_id;
        $ordenDetalle->book_id = $request->libro_id;
        $ordenDetalle->detail_price = $request->precio;
        $ordenDetalle->quantity = $request->cantidad;
        $ordenDetalle->save();
        return $ordenDetalle;
    }
    

    public static function updateOrdenDetalle($request, $id)
    {
        $ordenDetalle = OrdenDetalle::where('order_detail_id','=', $id)->first();
        $ordenDetalle->order_id = $request->orden_id;
        $ordenDetalle->book_id = $request->libro_id;
        $ordenDetalle->detail_price = $request->precio_detalle;
        $ordenDetalle->quantity = $request->cantidad;
        $ordenDetalle->save();
        return $ordenDetalle;
    }

    public static function deleteOrdenDetalle($orden_id, $book_id)
    {
        $ordenDetalle = OrdenDetalle::where('orden_id','=', $orden_id)->where('book_id','=', $book_id)->first();
        $ordenDetalle->delete();
        return $ordenDetalle;
    }
}
