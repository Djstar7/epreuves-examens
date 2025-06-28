<template>
    <div class="w-full min-h-screen mt-8">
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
        
        <!-- Liste des épreuves -->
        <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 lg:grid-cols-3" v-if="filteredExams.length !== 0">
            <div v-for="exam in filteredExams" :key="exam.id" 
                    class="relative overflow-hidden transition-transform duration-300 bg-white border border-gray-200 rounded-xl hover:-translate-y-1 hover:shadow-2xl">
                
                <!-- Exam Title Banner -->
                <div class="w-full px-6 py-4 text-center bg-gradient-to-r from-blue-600 to-blue-800">
                    <h2 class="text-xl font-bold text-white">
                        {{ `${exam.subject_cap} CAP ${exam.year_cap}` }}
                    </h2>
                </div>

                <div class="p-6">
                    <!-- Subject & Year Badge -->
                    <div class="flex justify-between gap-4 mb-6">
                        <span class="px-4 py-2 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full">
                            {{ exam.subject_cap }}
                        </span>
                        <span class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
                            {{ exam.branch_cap.match(/\(.*?\)/g)?.map(m => m.slice(1, -1)).join(' & ') || exam.branch_cap }}
                        </span>
                        <span class="px-4 py-2 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                            {{ exam.year_cap }}
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
                                <span class="text-xl font-bold text-indigo-600">{{ exam.price_cap }} FCFA</span>
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
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import NotFound404 from '../../../Components/NotFound404.vue'
import ButtonDownload from '../../../Components/ButtonDownload.vue'
import TitleExams from '../../../Components/TitleExams.vue'

const title = 'Épreuves du CAP'
const message = 'Retrouvez les sujets des années précédentes pour votre préparation au CAP'

const subjects = ref([
    // Enseignement Général
    'Français',
    'Anglais',
    'Mathématiques Générales',
    'Histoire-Géographie',
    'Éducation à la Citoyenneté',
    'Hygiène et Santé',
    
    // Enseignement Technologique et Professionnel
    'Marketing',
    'Législation',
    'Gestion sur ordinateur',
    'Éducation artistique',
    'Nutrition',
    'Cuisine Théorique',
    'Puériculture',
    'Sciences des Équipements',
    'Cuisine Pratique',
    'Aménagement',
    'Électricité Générale', 
    'Électrotechnique',
    'Dessin Technique',
    'Mécanique Générale',
    'Technologie Automobile',
    'Électricité Automobile',
    'Dessin Industriel',
    'Technologie des Matériaux',
    'Coupe et Couture',
    'Dessin de Mode',
    'Économie Familiale'
])
const branchs = ref([
    'Secrétariat Bureautique (SB)',
    'Comptabilité (CPT)',
    'Banque (BQ)',
    'Économie Sociale et Familiale (ESF)',
    'Fabrication Mécanique (F1)',
    'Électronique (F2)', 
    'Électrotechnique (F3)',
    'Génie Civil - Bâtiment (F4/BA)',
    'Génie Civil - Bureau d\'Études (F4/BE)',
    'Génie Civil - Travaux Publics (F4/TP)',
    'Froid et Climatisation (F5)',
    'Chimie Industrielle (CI)',
    'Maintenance Électromécanique (MEM)',
    'Maintenance Hospitalière / Biomédicale (MHB)',
    'Maintenance et Installation des Systèmes Électroniques (MISE)',
    'Mécanique Automobile (MA)',
    'Menuiserie - Ébénisterie (MEB)',
    'Menuiserie Agencement (MAGE)',
    'Industrie du Bois (IB-TMG)',
    'Industrie de l\'Habillement (IH)',
    'Installation Sanitaire (IS/RH)',
    'Construction Métallique (MF/CM)',
    'Bijouterie - Joaillerie (BIJO)',
    'Hôtellerie - Hébergement (HH)',
    'Hôtellerie - Restauration (HR)',
    'Tourisme - Agent de Comptoir (TAC)',
    'Tourisme - Guide Touristique (TGT)'
])
const sessions = ref(
    Array.from({ length: new Date().getFullYear() - 1990 + 1}, (_, i) => (2025 - i).toString())
)
const selectedSession = ref('')
const selectedSubject = ref('')
const selectedBranch = ref('')

const exams = ref([])

onMounted(async () => {
    // Initialisation des données ou récupération depuis une API
    // Exemple : fetchExams()
    const res = fetch('/api/cap', {
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
        const sessionMatch = !selectedSession.value || exam.year_cap == selectedSession.value
        const branchMatch = !selectedBranch.value || exam.branch_cap.includes(selectedBranch.value)
        const subjectMatch = !selectedSubject.value || exam.subject_cap.includes(selectedSubject.value)
        return sessionMatch && branchMatch && subjectMatch
    })
})

const filterExams = () => {
    // Add any additional filtering logic here
}

const downloadExam = (examId) => {
    // Implement download logic here
    console.log(`Downloading exam ${examId}`)
}
</script>
