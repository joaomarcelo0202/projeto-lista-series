<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TvmazeService;
use Illuminate\Http\Request;

class BuscaController extends Controller
{
    public function index(Request $request, TvmazeService $tvmaze)
    {
        $request->validate([
            'termo' => 'required|string|min:2',
        ]);

        return response()->json([
            'data' => $tvmaze->buscar($request->termo),
        ]);
    }
}