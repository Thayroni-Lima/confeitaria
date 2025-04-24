<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  confeitaria: Object
});

const form = useForm({ ...props.confeitaria });

function submit() {
  form.put(`/confeitarias/${props.confeitaria.id}`);
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Confeitaria</h1>

    <form @submit.prevent="submit" class="grid grid-cols-1 gap-4">
      <input v-model="form.nome" placeholder="Nome" class="border p-2" />
      <input v-model="form.telefone" placeholder="Telefone" class="border p-2" />
      <input v-model="form.cep" placeholder="CEP" class="border p-2" />
      <input v-model="form.rua" placeholder="Rua" class="border p-2" />
      <input v-model="form.numero" placeholder="Número" class="border p-2" />
      <input v-model="form.bairro" placeholder="Bairro" class="border p-2" />
      <input v-model="form.cidade" placeholder="Cidade" class="border p-2" />
      <input v-model="form.estado" placeholder="Estado" class="border p-2" />
      <input v-model="form.latitude" placeholder="Latitude" class="border p-2" />
      <input v-model="form.longitude" placeholder="Longitude" class="border p-2" />

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Atualizar
      </button>
    </form>
  </div>
</template>
