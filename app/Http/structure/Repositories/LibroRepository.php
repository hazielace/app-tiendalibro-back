<?php

namespace App\Http\structure\Repositories;
use App\Models\Libro;
use Illuminate\Support\Facades\DB;

class LibroRepository
{
    public static function getAllLibros()
    {
        return Libro::all();
    }

    public static function getAllSearchLibro($request)
    {
        $param = $request->input("param");
        $sql = "SELECT * FROM pos_book WHERE 1";

        if (!empty($param)) {
            $sql .= " AND (isbn LIKE ? OR name LIKE ?)";
            $data = DB::select($sql, ["%$param%", "%$param%"]);
        } else {
            $data = DB::select($sql);
        }

        return $data;
    }

    public static function getLibro($id)
    {
        $libro = Libro::where('book_id','=', $id)->first();
        return $libro ? [$libro] : [];
    }

    public static function addLibro($request)
    {
        $libro = new Libro();
        $libro->isbn = $request->isbn;
        $libro->name = $request->nombre;
        $libro->stock = $request->stock;
        $libro->current_price = $request->precio_actual;
        $libro->save();
        $lastInsertId = $libro->id;
        return $lastInsertId;
    }

    public static function updateLibro($id, $request)
    {
        $libro = Libro::where('book_id','=', $id)->first();
        $libro->isbn = $request->isbn;
        $libro->name = $request->nombre;
        $libro->stock = $request->stock;
        $libro->current_price = $request->precio_actual;
        $libro->save();
        return $libro;
    }

    public static function deleteLibro($id)
    {
        $libro = Libro::where('book_id','=', $id)->first();
        $libro->delete();
        return $libro;
    }
}