<script setup>
import { useForm } from '@inertiajs/vue3';
defineProps({ confeitarias: Array });

const form = useForm({
  confeitaria_id: '',
  nome: '',
  valor: '',
  descricao: '',
  imagens: [],
});

function handleFiles(event) {
  form.imagens = Array.from(event.target.files);
}

function submit() {
  form.post('/produtos', {
    forceFormData: true,
  });
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Novo Produto</h1>

    <form @submit.prevent="submit" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
      <label>
        Confeitaria
        <select v-model="form.confeitaria_id" class="border p-2 w-full">
          <option value="">Selecione...</option>
          <option v-for="c in confeitarias" :key="c.id" :value="c.id">{{ c.nome }}</option>
        </select>
      </label>

      <input v-model="form.nome" placeholder="Nome do Produto" class="border p-2 w-full" />
      <input v-model="form.valor" type="number" step="0.01" placeholder="R$ 0,00" class="border p-2 w-full" />
      <textarea v-model="form.descricao" class="border p-2 w-full" placeholder="Descrição do produto"></textarea>

      <label>
        Imagens do Produto (múltiplas)
        <input type="file" @change="handleFiles" multiple class="border p-2 w-full" />
      </label>

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Salvar Produto</button>
    </form>
  </div>
</template>
