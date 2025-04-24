<script setup>
import { onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import L from 'leaflet';

import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
});

const { confeitarias } = defineProps({ confeitarias: Array });
const csrfToken = usePage().props.csrf_token;

onMounted(() => {
  const map = L.map('map').setView([-15.78, -47.93], 4);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  setTimeout(() => map.invalidateSize(), 100);

  confeitarias.forEach(c => {
    const lat = parseFloat(c.latitude);
    const lng = parseFloat(c.longitude);

    if (!isNaN(lat) && !isNaN(lng)) {
      const marker = L.marker([lat, lng]).addTo(map);
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
    <div id="map" class="w-full h-[350px] rounded border shadow mb-6 relative z-0"></div>

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
