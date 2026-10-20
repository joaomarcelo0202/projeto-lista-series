# API

API em Laravel do projeto. Guarda a lista no SQLite e busca séries na [TVmaze](https://www.tvmaze.com/api).

## Rotas

Base: `http://127.0.0.1:8000/api`

| Método | Rota | Descrição |
|---|---|---|
| GET | /filmes | lista tudo |
| POST | /filmes | cadastra |
| GET | /filmes/{id} | mostra um |
| PUT | /filmes/{id} | atualiza |
| DELETE | /filmes/{id} | remove |
| GET | /busca?termo=friends | busca na TVmaze |

Campos: `titulo` (obrigatório), `ano`, `genero`, `poster`, `status` (`quero_ver` ou `ja_vi`), `nota` (1 a 5) e `comentario`.

As rotas se chamam `filmes` porque no começo a busca era de filmes no iTunes.

Exemplo de POST:

```json
{
  "titulo": "Interestelar",
  "ano": 2014,
  "genero": "Ficção científica"
}
```

## Como rodar

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Postman

A collection está em `postman/api-filmes.postman_collection.json`, é só importar.
