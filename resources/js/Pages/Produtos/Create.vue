<script setup>
import { useForm } from '@inertiajs/vue3';
defineProps({ confeitarias: Array });

const form = useForm({
  confeitaria_id: '',
  nome: '',
  valor: '',
  descricao: '',
  imagem: '',
});

function submit() {
  form.post('/produtos');
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Novo Produto</h1>

    <form @submit.prevent="submit" class="grid grid-cols-1 gap-4">

      <label class="block">
        Confeitaria
        <select v-model="form.confeitaria_id" class="border p-2 w-full">
          <option value="">Selecione...</option>
          <option v-for="c in confeitarias" :key="c.id" :value="c.id">
            {{ c.nome }}
          </option>
        </select>
        <span v-if="form.errors.confeitaria_id" class="text-red-600 text-sm">{{ form.errors.confeitaria_id }}</span>
      </label>

      <label class="block">
        Nome
        <input v-model="form.nome" placeholder="Nome do Produto" class="border p-2 w-full" />
        <span v-if="form.errors.nome" class="text-red-600 text-sm">{{ form.errors.nome }}</span>
      </label>

      <label class="block">
        Valor
        <input v-model="form.valor" type="number" step="0.01" placeholder="R$ 0,00" class="border p-2 w-full" />
        <span v-if="form.errors.valor" class="text-red-600 text-sm">{{ form.errors.valor }}</span>
      </label>

      <label class="block">
        Descrição
        <textarea v-model="form.descricao" class="border p-2 w-full" placeholder="Descrição do produto"></textarea>
        <span v-if="form.errors.descricao" class="text-red-600 text-sm">{{ form.errors.descricao }}</span>
      </label>

      <label class="block">
        Nome do Arquivo da Imagem (simples, por enquanto)
        <input v-model="form.imagem" placeholder="imagem1.jpg" class="border p-2 w-full" />
        <span v-if="form.errors.imagem" class="text-red-600 text-sm">{{ form.errors.imagem }}</span>
      </label>

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
        Salvar Produto
      </button>
    </form>
  </div>
</template>
