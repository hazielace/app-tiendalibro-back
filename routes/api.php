<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\OrdenDetalleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Cliente
Route::get('/clientes', [ClienteController::class, 'getClientes']);
Route::get('/cliente/{id}', [ClienteController::class, 'getCliente']);
Route::post('/cliente', [ClienteController::class, 'addCliente']);
Route::put('/cliente/{id}', [ClienteController::class, 'updateCliente']);
Route::delete('/cliente/{id}', [ClienteController::class, 'deleteCliente']);

// Libro
Route::post('/libros', [LibroController::class, 'getLibros']);
Route::get('/libro/{id}', [LibroController::class, 'getLibro']);
// Route::post('/libro/search',[LibroController::class, 'getSearchLibro']);
Route::post('/libro', [LibroController::class, 'addLibro']);
Route::put('/libro/{id}', [LibroController::class, 'updateLibro']);
Route::delete('/libro/{id}', [LibroController::class, 'deleteLibro']);

// Venta
Route::post('/cliente-orden', [OrdenController::class, 'addClienteOrden']);
Route::get('/ventas', [OrdenController::class, 'getOrdenes']);
Route::get('/venta/{id}', [OrdenController::class, 'getOrden']);
Route::post('/venta', [OrdenController::class, 'addOrden']);
Route::put('/venta/{id}', [OrdenController::class, 'updateOrden']);
Route::delete('/venta/{id}', [OrdenController::class, 'deleteOrden']);

// DetalleVenta
Route::get('/detalle-venta/{id}', [OrdenDetalleController::class, 'getOrdenDetalle']);




