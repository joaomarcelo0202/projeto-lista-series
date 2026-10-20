<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilmeRequest;
use App\Http\Resources\FilmeResource;
use App\Models\Filme;

class FilmeController extends Controller
{
    public function index()
    {
        return FilmeResource::collection(Filme::orderBy('id', 'desc')->get());
    }

    public function store(FilmeRequest $request)
    {
        $filme = Filme::create($request->validated());

        return new FilmeResource($filme);
    }

    public function show(Filme $filme)
    {
        return new FilmeResource($filme);
    }

    public function update(FilmeRequest $request, Filme $filme)
    {
        $filme->update($request->validated());

        return new FilmeResource($filme);
    }

    public function destroy(Filme $filme)
    {
        $filme->delete();

        return response()->json(['mensagem' => 'Filme removido com sucesso']);
    }
}