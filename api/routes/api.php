<?php

use App\Http\Controllers\Api\BuscaController;
use App\Http\Controllers\Api\FilmeController;
use Illuminate\Support\Facades\Route;

Route::get('/busca', [BuscaController::class, 'index']);
Route::apiResource('/filmes', FilmeController::class);