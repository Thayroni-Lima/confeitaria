<script setup>
import { usePage, Link } from '@inertiajs/vue3';
defineProps({ confeitarias: Array });

const csrfToken = usePage().props.csrf_token;
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Confeitarias</h1>

    <Link href="/confeitarias/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
      Nova Confeitaria
    </Link>

    <Link href="/produtos" class="inline-flex items-center bg-purple-500 text-white px-4 py-2 rounded mb-4">
      Todos os Produtos
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
    </svg>
    </Link>


    <div class="mt-4 space-y-2">
      <div v-for="confeitaria in confeitarias" :key="confeitaria.id" class="p-4 border rounded">
        <h2 class="text-lg font-semibold">{{ confeitaria.nome }}</h2>

        <div class="flex justify-between items-center">
          <Link :href="`/confeitarias/${confeitaria.id}/produtos`" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
            Ver Produtos
          </Link>
        </div>

        <p><strong>Telefone:</strong> {{ confeitaria.telefone }}</p>
        <p><strong>Endereço:</strong> {{ confeitaria.rua }}, {{ confeitaria.numero }} - {{ confeitaria.bairro }}, {{ confeitaria.cidade }} - {{ confeitaria.estado }}</p>
        <p><strong>Localização:</strong> Lat: {{ confeitaria.latitude }}, Long: {{ confeitaria.longitude }}</p>

        <div class="mt-2 space-x-4">
          <Link :href="`/confeitarias/${confeitaria.id}/edit`" class="text-blue-600 underline">Editar</Link>

          <form :action="`/confeitarias/${confeitaria.id}`" method="POST" class="inline-block">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" :value="csrfToken" />
            <button type="submit" class="text-red-600 underline">Excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
