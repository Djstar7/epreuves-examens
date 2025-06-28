<template>
    <div class="min-h-screen mt-4 bg-gray-100">
        <div class="w-full">
            <!-- En-tête avec message de bienvenue et titre -->
            <TitleExams :head="title" :message="message" />

            <!-- Filters Section -->
            <div class="mx-auto mb-8 max-w-7xl">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Rechercher une école..."
                            class="border-2 border-gray-300 rounded-md form-input outline-0"
                        />
                        <select
                            v-model="selectedSession"
                            class="bg-gray-200 border-gray-300 rounded-md form-select outline-0"
                        >
                            <option value="">Toutes les années</option>
                            <option     
                                v-for="session in sessions"
                                :key="session"
                                :value="session"
                                >
                                {{ session }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Liste des concours -->
            <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 lg:grid-cols-3" v-if="filteredSchools">
                <div
                    v-for="school in filteredSchools"
                    :key="school.id"
                    class="relative overflow-hidden transition-transform duration-300 bg-white border border-gray-200 rounded-xl hover:-translate-y-1 hover:shadow-2xl"
                >
                    <!-- School Title Banner -->
                    <div class="w-full px-6 py-4 text-center bg-gradient-to-r from-blue-600 to-blue-800">
                        <h2 class="text-xl font-bold text-white">
                            {{ school.school_concours }}
                        </h2>
                    </div>

                    <div class="p-6">
                        <!-- Subjects Information -->
                        <div class="mb-6 space-y-3">
                            <div class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-lg">
                                <span class="text-sm font-semibold text-blue-700">
                                    {{ school.subject_concours }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg">
                                <span class="text-xl font-bold">Cycle: </span>
                                <span class="text-sm font-semibold text-gray-700">
                                    {{ school.cycle_concours }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg">
                                <span class="font-bold">Spécialité:</span> 
                                <span class="text-sm font-semibold text-gray-700">
                                    {{ school.speciality_concours }}
                                </span>
                            </div>
                        </div>

                        <!-- Price Info -->
                        <div class="p-4 mb-6 bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-xl font-bold text-indigo-600">{{ school.price_concours }} FCFA</span>
                                </div>
                                <span class="px-3 py-1 text-xl font-medium text-green-700 bg-green-100 rounded-full">
                                     {{ school.year_concours }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4">
                            <ButtonDownload />
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <NotFound404 />
            </div>
        </div>

    </div>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue'
import NotFound404 from '../../Components/NotFound404.vue'
import ButtonDownload from '../../Components/ButtonDownload.vue'
import TitleExams from '../../Components/TitleExams.vue'

const title = 'Concours d\'entrée'
const message = 'Retrouvez tous les concours classés par école et année'

// État principal
const schools = ref([])

// États pour la recherche et le filtrage
const searchQuery = ref('')
const selectedSession = ref('')
const sessions = ref(
    Array.from({ length: new Date().getFullYear() - 1990 + 1}, (_, i) => (2025 - i).toString())
)
// Récupération des données depuis une API simulée
onMounted(async () => {
    fetch ('/api/concours', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        })
        .then(response => response.json())
        .then(data => {
            schools.value = data;
        })
        
        .catch(error => {
            console.error('Error fetching data:', error);
        })
})

// Calcul des écoles filtrées
const filteredSchools = computed(() => {
  return schools.value.filter((school) => {
    const matchesSearch = school.school_concours.toLowerCase().includes(searchQuery.value.toLowerCase())
    const matchesSession = !selectedSession.value || school.year_concours == selectedSession.value
    return matchesSearch && matchesSession
  })
})
</script>
