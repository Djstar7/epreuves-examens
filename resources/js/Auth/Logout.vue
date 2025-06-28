<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <div class="mb-8 text-center">
                <h2 class="mb-2 text-3xl font-bold text-indigo-600">Déconnexion</h2>
                <p class="text-gray-600">Êtes-vous sûr de vouloir vous déconnecter ?</p>
            </div>
            
            <div class="space-y-4">
                <button 
                    @click="handleLogout" 
                    class="flex items-center justify-center w-full px-4 py-3 text-white transition duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700"
                >
                    <span class="mr-2">Confirmer la déconnexion</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <button 
                    @click="goBack" 
                    class="w-full px-4 py-3 text-gray-700 transition duration-200 border-2 border-gray-300 rounded-lg hover:bg-gray-50"
                >
                    Annuler
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { ref } from 'vue'

const router = useRouter()

const handleLogout = async () => {
    try {
        // Ici, ajoutez votre logique de déconnexion
        // Par exemple : localStorage.removeItem('token')
        localStorage.clear()
        // Rediriger vers la page de connexion
        router.push('/login')
    } catch (error) {
        console.error('Erreur lors de la déconnexion:', error)
    }
}

const goBack = () => {
    router.back()
}
</script>