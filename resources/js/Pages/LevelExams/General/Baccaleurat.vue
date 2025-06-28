<template>
    <div class="min-h-screen mt-4 bg-gray-100">
        <div class="w-full">
            <!-- En-tête avec message de bienvenue et titre -->
            <TitleExams :head="title" :message="message" />

            <!-- Filters Section -->
            <div class="mx-auto mb-8 max-w-7xl">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <select v-model="selectedSubject" class="bg-gray-200 border-gray-300 rounded-md form-select outline-0">
                            <option value="">Sélectionner une matière</option>
                            <option v-for="subject in subjects" :key="subject" :value="subject">{{ subject }}</option>
                        </select>
                        <select v-model="selectedSeries" class="bg-gray-200 border-gray-300 rounded-md form-select outline-0">
                            <option value="">Sélectionner une série</option>
                            <option v-for="serie in series" 
                                    :key="serie" 
                                    :value="serie">
                                {{ serie }}
                            </option>
                        </select>
                        <select v-model="selectedSession" class="bg-gray-200 border-gray-300 rounded-md form-select outline-0">
                            <option value="">Sélectionner une session</option>
                            <option v-for="session in sessions" :key="session" :value="session">{{ session }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Liste des épreuves -->
            <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 lg:grid-cols-3" v-if="filteredExams.length !== 0">
                <div v-for="exam in filteredExams" :key="exam.id" 
                     class="relative overflow-hidden transition-transform duration-300 bg-white border border-gray-200 rounded-xl hover:-translate-y-1 hover:shadow-2xl">
                    
                    <!-- Exam Title Banner -->
                    <div class="w-full px-6 py-4 text-center bg-gradient-to-r from-blue-600 to-blue-800">
                        <h2 class="text-xl font-bold text-white">
                            {{ `${exam.subject_bac_gen} Baccalaureat ${exam.year_bac_gen}` }}
                        </h2>
                    </div>

                    <div class="p-6">
                        <!-- Subject & Year Badge -->
                        <div class="flex justify-between gap-4 mb-6">
                            <span class="px-4 py-2 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full">
                                {{ exam.subject_bac_gen }}
                            </span>
                            <span class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
                                {{ exam.serie_bac_gen.split(', ').join(' & ') }}
                            </span>
                            <span class="px-4 py-2 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                                {{ exam.year_bac_gen }}
                            </span>
                        </div>

                        <!-- Price Info -->
                        <div class="p-4 mb-6 bg-gray-50 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-xl font-bold text-indigo-600">{{ exam.price_bac_gen }} FCFA</span>
                                </div>
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
import NotFound404 from '../../../Components/NotFound404.vue'
import ButtonDownload from '../../../Components/ButtonDownload.vue'
import TitleExams from '../../../Components/TitleExams.vue'

const title = 'Épreuves du Baccalauréat'
const message = 'Retrouvez toutes les épreuves classées par série, année et matière'

// États
const selectedSeries = ref('')
const selectedSession = ref('')
const selectedSubject = ref('')


const exams = ref([])


const subjects = [
    'Mathématiques', 
    'Physique',
    'Chimie', 
    'Informatique',
    'SVTEEHB',
    'Français',
    'Anglais',
    'Philosophie',
    'Histoire-Géographie',
    'Allemand',
    'Espagnol',
    'Chinois',
    'Arabe',
    'Italien',
    'ECM',
    'EPS'
]
const series = [
    'A4',
    'B', 
    'C', 
    'D', 
    'TI'
]
const sessions = ref(
    Array.from({ length: new Date().getFullYear() - 1990 + 1}, (_, i) => (2025 - i).toString())
)
onMounted(async () => {
    // Initialisation des données ou récupération depuis une API
    // Exemple : fetchExams()
    const res = fetch('/api/baccgen', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    res.then(response => response.json())
        .then(data => {
            exams.value = data
        })
        .catch(error => {
            console.error('Error fetching exams:', error)
        })
})
// Filtrage des examens
const filteredExams = computed(() => {
    return exams.value.filter(exam => {
        const seriesMatch = !selectedSeries.value || exam.serie_bac_gen.includes(selectedSeries.value)
        const sessionMatch = !selectedSession.value || exam.year_bac_gen == selectedSession.value
        const subjectMatch = !selectedSubject.value || exam.subject_bac_gen == selectedSubject.value
        return seriesMatch && sessionMatch && subjectMatch
    })
})





</script>