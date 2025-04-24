<script setup>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
const props = defineProps({ produto: Object, confeitarias: Array });

const form = useForm({
  confeitaria_id: props.produto.confeitaria_id,
  nome: props.produto.nome,
  valor: props.produto.valor,
  descricao: props.produto.descricao,
  imagens_novas: [],
  imagens_existentes: [...(props.produto.imagem ?? [])], // caminhos existentes
});

function handleNewImages(event) {
  form.imagens_novas = Array.from(event.target.files);
}

function removeImagemExistente(index) {
  form.imagens_existentes.splice(index, 1);
}

function submit() {
  const formData = new FormData();

  formData.append('_method', 'PUT');
  formData.append('confeitaria_id', form.confeitaria_id);
  formData.append('nome', form.nome);
  formData.append('valor', form.valor);
  formData.append('descricao', form.descricao);

  form.imagens_existentes.forEach((img, index) => {
    formData.append(`imagens_existentes[${index}]`, img);
  });

  form.imagens_novas.forEach((file) => {
    formData.append('imagens_novas[]', file);
  });

  router.post(`/produtos/${props.produto.id}`, formData, {
    preserveScroll: true,
    onSuccess: () => {
      console.log('Produto atualizado com sucesso!');
    },
    onError: (errors) => {
      console.log('Erro ao atualizar:', errors);
    }
  });
}

</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Produto</h1>

    <form @submit.prevent="submit" class="grid grid-cols-1 gap-4" enctype="multipart/form-data">
      <label>
        Confeitaria
        <select v-model="form.confeitaria_id" class="border p-2 w-full">
          <option value="">Selecione...</option>
          <option v-for="c in confeitarias" :key="c.id" :value="c.id">{{ c.nome }}</option>
        </select>
      </label>

      <input v-model="form.nome" placeholder="Nome" class="border p-2 w-full" />
      <input v-model="form.valor" type="number" step="0.01" placeholder="Valor" class="border p-2 w-full" />
      <textarea v-model="form.descricao" placeholder="Descrição" class="border p-2 w-full"></textarea>

      <label>
        Imagens atuais
        <div class="flex flex-wrap gap-2 mt-2">
          <div v-for="(img, index) in form.imagens_existentes" :key="index" class="relative">
            <img :src="`/storage/${img}`" class="h-20 w-20 object-cover border rounded" />
            <button type="button" @click="removeImagemExistente(index)" class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded">
              x
            </button>
          </div>
        </div>
      </label>

      <label>
        Adicionar novas imagens
        <input type="file" @change="handleNewImages" multiple class="border p-2 w-full" />
      </label>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar Alterações</button>
    </form>
  </div>
</template>
