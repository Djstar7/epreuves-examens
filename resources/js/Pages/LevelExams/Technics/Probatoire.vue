<template>
    <div class="min-h-screen mt-4">
        <div class="w-full">
            <!-- Header Section -->
            <TitleExams :head="title" :message="message" />

            <!-- Filters Section -->
            <div class="mx-auto mb-8 max-w-7xl">
                <div class="p-4 bg-white rounded-lg shadow-sm">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <select v-model="selectedSubject" class="bg-gray-200 border-gray-300 rounded-md form-select outline-0">
                            <option value="">Sélectionner une matière</option>
                            <option v-for="subject in subjects" :key="subject" :value="subject">{{ subject }}</option>
                        </select>
                        <select v-model="selectedBranch" class="bg-gray-200 border-gray-300 rounded-md form-select outline-0">
                            <option value="">Sélectionner une filiere</option>
                            <option v-for="branch in branchs" :key="branch" :value="branch">{{ branch }}</option>
                        </select>
                        <select v-model="selectedSession" class="bg-gray-200 border-gray-300 rounded-md form-select outline-0">
                            <option value="">Sélectionner une session</option>
                            <option v-for="session in sessions" :key="session" :value="session">{{ session }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Subjects Grid -->
            <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 lg:grid-cols-3" v-if="filteredExams.length !== 0">
                <div v-for="exam in filteredExams" :key="exam.id" 
                     class="relative overflow-hidden transition-transform duration-300 bg-white border border-gray-200 rounded-xl hover:-translate-y-1 hover:shadow-2xl">
                    
                    <!-- Exam Title Banner -->
                    <div class="w-full px-6 py-4 text-center bg-gradient-to-r from-blue-600 to-blue-800">
                        <h2 class="text-xl font-bold text-white">
                            {{ `${exam.subject_probatoire_tech} Probatoire ${exam.year_probatoire_tech}` }}
                        </h2>
                    </div>

                    <div class="p-6">
                        <!-- Subject & Series Badge -->
                        <div class="flex justify-between gap-4 mb-6">
                            <span class="px-4 py-2 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full">
                                {{ exam.subject_probatoire_tech }}
                            </span>
                            <span class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
                                {{ exam.branch_probatoire_tech.match(/\(.*?\)/g)?.map(m => m.slice(1, -1)).join(' & ') || exam.branch_probatoire_tech }}
                            </span>
                            <span class="px-4 py-2 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                                {{ exam.year_probatoire_tech }}
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
                                    <span class="text-xl font-bold text-indigo-600">{{ exam.price_probatoire_tech}} FCFA</span>
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

const title = 'Épreuves du Probatoire'
const message = 'Retrouvez les anciens sujets des examens officiels'

const exams = ref([])

const selectedSession = ref('')
const selectedBranch = ref('')
const selectedSubject = ref('')

const sessions = ref(
    Array.from({ length: new Date().getFullYear() - 1990 + 1}, (_, i) => (2025 - i).toString())
)
const branchs = ref([
    // Sciences et Technologies du Tertiaire
    'Action et Communication Administratives (ACA)',
    'Action et Communication Commerciales (ACC)', 
    'Comptabilité et Gestion (CG)',
    'Fiscalité et Informatique de Gestion (FIG)',
    'Sciences Économiques et Sociales (SES)',
    'Hôtellerie Hébergement (HO-HE)',
    'Hôtellerie Restaurant-Bar (HO-RB)',
    'Hôtellerie Cuisine (HO-CU)', 
    'Tourisme Accueil (TO-AAT)',
    'Économie Sociale et Familiale (ESF)',

    // Techniques Industrielles 
    'Fabrication Mécanique (F1)',
    'Électronique (F2)',
    'Électrotechnique (F3)',
    'Génie Civil Bâtiment (F4/BA)',
    'Génie Civil Travaux Publics (F4/TP)', 
    'Génie Civil Bureau d\'Études (F4/BE)',
    'Froid et Climatisation (F5)',
    'Génie Chimique (F6)', 
    'Sciences et Techniques Biologiques (F7)',
    'Sciences Médico-sociales (F8)',

    'Technique Agricole (TAG)',
    'Industrie du Bois (IB)',
    'Maintenance Électromécanique (MEM)'
])
const subjects = ref([
    // Matières Communes
    'Français',
    'Anglais',
    'Mathématiques',
    'Physique-Chimie',
    'Histoire-Géographie',
    'Éducation à la Citoyenneté',
    'Éducation Physique',
    
    // Matières Techniques
    'Machines Électriques',
    'Électronique',
    'Dessin Technique',
    'Technologie Électrotechnique',
    
    // Matières Commerciales
    'Rédaction Professionnelle',
    'Organisation Administrative',
    'Comptabilité Générale',
    'Économie Générale',
    'Droit',
    'Marketing',
    'Techniques Commerciales',
    
    // Matières Spécialisées
    'Sciences Biologiques',
    'Technologie Agricole',
    'Informatique',
    'Systèmes d\'Information'
])

onMounted(async () => {
    // Initialisation des données ou récupération depuis une API
    // Exemple : fetchExams()
    const res = fetch('/api/probatoiretech', {
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
        const sessionMatch = !selectedSession.value || exam.year_probatoire_tech == selectedSession.value
        const branchMatch = !selectedBranch.value || exam.branch_probatoire_tech.include(selectedBranch.value)
        const subjectMatch = !selectedSubject.value || exam.subject_probatoire_tech.include(selectedSubject.value)
        return sessionMatch && branchMatch && subjectMatch
    })
})
const downloadExam = (exam) => {
    // Implement download logic
    console.log('Downloading:', exam.fileUrl)
}

const previewExam = (exam) => {
    // Implement preview logic
    console.log('Previewing:', exam.id)
}
</script>