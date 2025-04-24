<script setup>
import { onMounted } from 'vue';
import L from 'leaflet';
defineProps({ confeitarias: Array });

onMounted(() => {
  const map = L.map('map').setView([-7.11725761108947, -34.83948410556408], 0.00001); // Melhor de João Pessoa

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  confeitarias.forEach(confeitaria => {
    if (confeitaria.latitude && confeitaria.longitude) {
      const marker = L.marker([confeitaria.latitude, confeitaria.longitude]).addTo(map);

      marker.bindPopup(`
        <strong>${confeitaria.nome}</strong><br/>
        ${confeitaria.rua}, ${confeitaria.numero}<br/>
        ${confeitaria.cidade} - ${confeitaria.estado}<br/>
        <a href="/confeitarias/${confeitaria.id}/produtos" class="text-blue-500">Ver Produtos</a>
      `);
    }
  });
});
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Mapa de Confeitarias</h1>

    <div id="map" class="w-full h-[500px] rounded shadow border"></div>
  </div>
</template>
