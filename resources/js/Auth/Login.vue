<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-3xl font-bold text-center text-gray-800">
                    Connexion
                </h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="handleLogin">
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            v-model="email"
                            required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Votre email"
                        />
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input
                            id="password"
                            type="password"
                            v-model="password"
                            required
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Votre mot de passe"
                        />
                    </div><br>

                    <router-link
                        to="/forgot-password"
                        class="text-sm text-blue-600 hover:text-blue-500"
                    >
                        Mot de passe oublié? 
                    </router-link>
                </div>

                <button
                    type="submit"
                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Se connecter
                </button>

                <div class="text-sm ">
                    <span>Vous n'avez pas de compte?  </span>
                    <router-link
                        to="/register"
                        class="text-sm text-blue-600 hover:text-blue-500"
                    >
                        Créer un compte
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')
const password = ref('')

const handleLogin = async () => {
    try {
        // Ajoutez votre logique de connexion ici
        console.log('Tentative de connexion avec:', email.value)
    } catch (error) {
        console.error('Erreur de connexion:', error)
    }
}
</script>
