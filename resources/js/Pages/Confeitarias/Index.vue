<script setup>
import { onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import L from 'leaflet';

defineProps({
  confeitarias: Array
});

const csrfToken = usePage().props.csrf_token;

onMounted(() => {
  const map = L.map('map').setView([-15.78, -47.93], 4);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Corrigir o bug de renderização (muito importante!)
  setTimeout(() => {
    map.invalidateSize();
  }, 100);

  confeitarias.forEach(c => {
    if (c.latitude && c.longitude) {
      const marker = L.marker([c.latitude, c.longitude]).addTo(map);
      marker.bindPopup(`
        <strong>${c.nome}</strong><br/>
        ${c.rua}, ${c.numero} - ${c.bairro}<br/>
        ${c.cidade} - ${c.estado}<br/>
        <a href="/confeitarias/${c.id}/produtos" class="text-blue-500">Ver Produtos</a>
      `);
    }
  });
});

</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Confeitarias</h1>

    <div class="mb-4 flex flex-wrap gap-4">
      <Link href="/confeitarias/create" class="bg-blue-500 text-white px-4 py-2 rounded">Nova Confeitaria</Link>
      <Link href="/produtos" class="bg-green-500 text-white px-4 py-2 rounded">Todos os Produtos</Link>
    </div>

    <!-- Mapa -->
<div id="map" class="w-full h-[350px] rounded border shadow mb-6 z-0 relative"></div>

    <!-- Lista de Confeitarias -->
    <div class="space-y-4">
      <div
        v-for="confeitaria in confeitarias"
        :key="confeitaria.id"
        class="p-4 border rounded shadow-sm"
      >
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold">{{ confeitaria.nome }}</h2>
          <Link :href="`/confeitarias/${confeitaria.id}/produtos`" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
            Ver Produtos
          </Link>
        </div>
        <p><strong>Telefone:</strong> {{ confeitaria.telefone }}</p>
        <p><strong>Endereço:</strong> {{ confeitaria.rua }}, {{ confeitaria.numero }} - {{ confeitaria.bairro }}, {{ confeitaria.cidade }} - {{ confeitaria.estado }}</p>
        <p><strong>Localização:</strong> Lat: {{ confeitaria.latitude }}, Long: {{ confeitaria.longitude }}</p>
      </div>
    </div>
  </div>
</template>
