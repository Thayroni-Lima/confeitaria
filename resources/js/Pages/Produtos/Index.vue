<script setup>
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
  produtos: Array
});

const csrfToken = usePage().props.csrf_token;
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Produtos</h1>

    <div class="mb-4 flex flex-wrap gap-4">
      <Link href="/produtos/create" class="bg-blue-500 text-white px-4 py-2 rounded">
        Novo Produto
      </Link>
      <Link href="/confeitarias" class="bg-green-500 text-white px-4 py-2 rounded">
        <- Voltar para Confeitarias
      </Link>
      </div>

    <div class="mt-4 space-y-4">
      <div
        v-for="produto in produtos"
        :key="produto.id"
        class="p-4 border rounded shadow-sm"
      >
        <h2 class="text-lg font-semibold">{{ produto.nome }}</h2>
        <p><strong>Valor:</strong> R$ {{ parseFloat(produto.valor).toFixed(2) }}</p>
        <p><strong>Descrição:</strong> {{ produto.descricao || '---' }}</p>
        <p><strong>Confeitaria:</strong> {{ produto.confeitaria?.nome }}</p>

        <div v-if="produto.imagem && produto.imagem.length" class="mt-2 flex gap-2">
          <img
            v-for="(img, index) in produto.imagem"
            :key="index"
            :src="`/storage/${img}`"
            alt="Imagem do produto"
            class="h-20 w-20 object-cover border rounded"
          />
        </div>

        <div class="mt-3 space-x-4">
          <Link :href="`/produtos/${produto.id}/edit`" class="text-blue-600 underline">Editar</Link>

          <form :action="`/produtos/${produto.id}`" method="POST" class="inline-block" @submit.prevent="() => $refs[`form_${produto.id}`].submit()" :ref="`form_${produto.id}`">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" :value="csrfToken" />
            <button type="submit" class="text-red-600 underline">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
