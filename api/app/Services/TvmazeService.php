<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TvmazeService
{
    public function buscar(string $termo): array
    {
        $resposta = Http::get('https://api.tvmaze.com/search/shows', [
            'q' => $termo,
        ]);

        if ($resposta->failed()) {
            return [];
        }

        return collect($resposta->json())->map(fn ($item) => [
            'titulo' => $item['show']['name'],
            'ano' => $item['show']['premiered'] ? (int) substr($item['show']['premiered'], 0, 4) : null,
            'genero' => $item['show']['genres'][0] ?? null,
            'poster' => $item['show']['image']['original'] ?? null,
        ])->all();
    }
}