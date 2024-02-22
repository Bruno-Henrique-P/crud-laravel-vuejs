<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get("cliente",[App\Http\Controllers\ClienteController::class,"cliente"]);
Route::get("vendedor",[App\Http\Controllers\VendedorController::class,"vendedor"]);
Route::post("savecliente",[App\Http\Controllers\ClienteController::class,"savecliente"]);
Route::delete("deletecliente/{id}",[App\Http\Controllers\ClienteController::class,"deletecliente"]);
Route::get("getcliente/{id}",[App\Http\Controllers\ClienteController::class,"getcliente"]);
Route::post("updatecliente/{id}",[App\Http\Controllers\ClienteController::class,"updatecliente"]);

Route::get("orcamento",[App\Http\Controllers\OrcamentoController::class,"orcamento"]);
Route::get("getcorcamento/{id}",[App\Http\Controllers\OrcamentoController::class,"getcorcamento"]);
Route::post("saveorcamento",[App\Http\Controllers\OrcamentoController::class,"saveorcamento"]);
Route::delete("deleteorcamento/{id}",[App\Http\Controllers\OrcamentoController::class,"deleteorcamento"]);
Route::post("updateorcamento/{id}",[App\Http\Controllers\OrcamentoController::class,"updateorcamento"]);

Route::post("search",[App\Http\Controllers\OrcamentoController::class,"pesquisaOrcamento"]);


