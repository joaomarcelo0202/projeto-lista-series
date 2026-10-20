<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'ano' => $this->ano,
            'genero' => $this->genero,
            'poster' => $this->poster,
            'status' => $this->status,
            'nota' => $this->nota,
            'comentario' => $this->comentario,
            'criado_em' => $this->created_at?->format('d/m/Y H:i'),
        ];
    }
}