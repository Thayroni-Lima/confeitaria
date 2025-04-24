<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  produtos: Array
});
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Produtos</h1>

    <Link href="/produtos/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
      Novo Produto
    </Link>

    <div class="mt-4 space-y-2">
      <div v-for="produto in produtos" :key="produto.id" class="p-4 border rounded">
        <h2 class="text-lg font-semibold">{{ produto.nome }}</h2>
        <p><strong>Valor:</strong> R$ {{ parseFloat(produto.valor).toFixed(2) }}</p>
        <p><strong>Descrição:</strong> {{ produto.descricao || '---' }}</p>
        <p><strong>Confeitaria:</strong> {{ produto.confeitaria?.nome }}</p>
        <p><strong>Imagem:</strong> {{ produto.imagem || 'Sem imagem' }}</p>

        <div class="mt-2 space-x-4">
          <Link :href="`/produtos/${produto.id}/edit`" class="text-blue-600 underline">Editar</Link>
          <form :action="`/produtos/${produto.id}`" method="POST" class="inline-block" @submit.prevent="() => $refs[`form_${produto.id}`].submit()" :ref="`form_${produto.id}`">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" :value="$page.props.csrf_token" />
            <button type="submit" class="text-red-600 underline">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
