# Lista de Séries

Trabalho de Back-end. É uma lista do que eu quero assistir: dá pra buscar séries, adicionar na lista, marcar como visto, dar nota e comentar.

O projeto tem duas partes:

- [`api`](api): API em Laravel 13 com SQLite, com as rotas RESTful e a busca na TVmaze
- [`front`](front): front em Vue que consome essa API

A atividade pedia:
1. Consumir uma API online: usei a [TVmaze](https://www.tvmaze.com/api) para buscar séries (comecei com a do iTunes, mas a busca de filmes dela parou de funcionar).
2. Criar uma API com rotas RESTful e Resource e testar no Postman.
3. Desafio: consumir essa API de outro projeto, em outro framework (o front em Vue).

## Como rodar

Primeiro a API:

```bash
cd api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Depois, em outro terminal, o front:

```bash
cd front
npm install
npm run dev
```

A API fica em `http://127.0.0.1:8000/api` e o front em `http://localhost:5173`.
