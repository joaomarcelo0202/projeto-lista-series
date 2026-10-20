<script setup>
import { ref, onMounted } from 'vue'

const api = 'http://127.0.0.1:8000/api'
const headers = { 'Content-Type': 'application/json', Accept: 'application/json' }

const filmes = ref([])
const resultados = ref([])
const termo = ref('')
const titulo = ref('')

async function carregar() {
  const resposta = await fetch(`${api}/filmes`)
  const json = await resposta.json()
  filmes.value = json.data
}

async function salvar(filme) {
  await fetch(`${api}/filmes`, { method: 'POST', headers, body: JSON.stringify(filme) })
  carregar()
}

function adicionar() {
  if (!titulo.value) return
  salvar({ titulo: titulo.value })
  titulo.value = ''
}

async function buscar() {
  if (termo.value.length < 2) return
  const resposta = await fetch(`${api}/busca?termo=${encodeURIComponent(termo.value)}`)
  const json = await resposta.json()
  resultados.value = json.data
}

async function alternarStatus(filme) {
  const status = filme.status === 'ja_vi' ? 'quero_ver' : 'ja_vi'
  await fetch(`${api}/filmes/${filme.id}`, { method: 'PUT', headers, body: JSON.stringify({ status }) })
  carregar()
}

async function remover(id) {
  await fetch(`${api}/filmes/${id}`, { method: 'DELETE', headers })
  carregar()
}

onMounted(carregar)
</script>

<template>
  <main>
    <h1>Minha lista de séries</h1>

    <section>
      <h2>Buscar na TVmaze</h2>
      <form @submit.prevent="buscar">
        <input v-model="termo" placeholder="Digite um nome..." />
        <button>Buscar</button>
      </form>

      <div class="grade">
        <div v-for="item in resultados" :key="item.titulo + item.ano" class="card">
          <img v-if="item.poster" :src="item.poster" />
          <strong>{{ item.titulo }}</strong>
          <span>{{ item.ano }} - {{ item.genero }}</span>
          <button @click="salvar(item)">Adicionar</button>
        </div>
      </div>
    </section>

    <section>
      <h2>Minha lista</h2>
      <form @submit.prevent="adicionar">
        <input v-model="titulo" placeholder="Adicionar série pelo título..." />
        <button>Adicionar</button>
      </form>

      <p v-if="filmes.length === 0">Nenhuma série na lista.</p>

      <div class="grade">
        <div v-for="filme in filmes" :key="filme.id" class="card">
          <img v-if="filme.poster" :src="filme.poster" />
          <strong>{{ filme.titulo }}</strong>
          <span>{{ filme.ano }} {{ filme.genero }}</span>
          <span :class="filme.status">{{ filme.status === 'ja_vi' ? 'Já vi' : 'Quero ver' }}</span>
          <button @click="alternarStatus(filme)">Marcar como {{ filme.status === 'ja_vi' ? 'quero ver' : 'visto' }}</button>
          <button class="remover" @click="remover(filme.id)">Remover</button>
        </div>
      </div>
    </section>
  </main>
</template>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f4f4f4;
  margin: 0;
}

main {
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
}

form {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}

input {
  flex: 1;
  padding: 8px;
}

button {
  padding: 8px;
  cursor: pointer;
}

.grade {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 12px;
}

.card {
  background: white;
  padding: 10px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.card img {
  width: 100%;
  border-radius: 4px;
}

.ja_vi {
  color: green;
}

.quero_ver {
  color: orange;
}

.remover {
  background: #e74c3c;
  color: white;
  border: none;
}
</style>