<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkPagamentoController;

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

Route::get('/link', [LinkPagamentoController::class, 'getLinks']);
Route::post('/link', [LinkPagamentoController::class, 'createLink']);
Route::delete('/link/{linkId}', [LinkPagamentoController::class, 'excluirLinks']);