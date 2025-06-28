<template>
    <div>
    <!-- Le header ne s'affiche pas pour certaines routes -->
    <div class="flex flex-col min-h-screen">
      <Header v-if="showHeader" />

      <!-- Main content -->
      <div class="flex-grow">
        <router-view />
      </div>

      <!-- Footer -->
      <Footer class="bottom-0" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import Header from './Layouts/Header.vue'
import Footer from './Layouts/Footer.vue'
const route = useRoute()


// Liste des routes sans header
const routesSansHeader = ['/login', '/register','/logout']

// Le header ne s'affiche que si la route n'est pas dans la liste
const showHeader = computed(() => !routesSansHeader.includes(route.path))
</script>
