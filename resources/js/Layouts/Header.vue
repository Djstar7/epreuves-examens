<template>
    <header class="fixed top-0 z-50 w-full bg-white shadow-md">
        <nav class="container px-4 py-3 mx-auto">
            <div class="flex items-center justify-between w-full">
                <!-- Logo et titre -->
                <div class="flex items-center space-x-3">
                    <img src="../../../../public/assets/logo.png" alt="Logo" class="w-20 h-20" />
                    <h1 class="text-2xl font-bold text-blue-800">Epreuves-Examens</h1>
                </div>

                <!-- Navigation -->
                <div class="items-center hidden space-x-8 text-3xl md:flex">
                    <router-link 
                        to="/"
                        class="relative px-4 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-105 hover:shadow-lg group"
                        :class="{ 'bg-blue-600 text-white hover:text-gray-600': $route.name == 'home' }"
                    >
                        <span class="relative z-10">Accueil</span>
                    </router-link>
                    <router-link 
                        to="/exams"
                        class="relative px-4 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-105 hover:shadow-lg group"
                        :class="{ ' bg-blue-600 text-white hover:text-gray-600': $route.path.startsWith('/exams') }"
                        >
                        <span class="relative z-10">Examens</span>
                    </router-link>
                    <router-link 
                        to="/orders"
                        class="relative px-4 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-105 hover:shadow-lg group"
                        :class="{ 'text-white bg-blue-600 hover:text-gray-600': $route.path.startsWith('/orders') }"
                    >
                        <span class="relative z-10">Commandes</span>
                    </router-link>
                    <router-link 
                        to="/contact"
                        class="relative px-4 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-105 hover:shadow-lg group"
                        :class="{ 'text-white bg-blue-600 hover:text-gray-600': $route.path.startsWith('/contact') }"
                    >
                        <span class="relative z-10">Contact</span>
                    </router-link>
                </div>

                <!-- Boutons d'authentification -->
                <div class="items-center hidden space-x-4 md:flex">
                    <router-link to="/login" class="px-4 py-2 text-blue-600 transition-colors duration-200 border-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white">
                        Se Conecter
                    </router-link>
                    <router-link to="/register" class="px-4 py-2 text-blue-600 transition-colors duration-200 border-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white">
                        S'inscrire
                    </router-link>
                </div>

                <!-- Menu mobile -->
                <div class="md:hidden">
                    <button class="text-gray-700" @click="toggleMobile">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    
                    <!-- Mobile Menu -->
                    <div v-if="isMobileMenuOpen" 
                         class="absolute left-0 right-0 w-full p-4 mt-2 bg-white shadow-lg">
                        <div class="flex flex-col space-y-4">
                            <router-link 
                                to="/"
                                class="relative px-8 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-10 hover:shadow-lg group"
                                :class="{ 'bg-blue-600': $route.name == 'home' }">  
                                <span class="relative z-10">Accueil</span>
                            </router-link>
                            <router-link 
                                to="/exams"
                                class="relative px-8 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-10 hover:shadow-lg group"
                                :class="{ 'bg-blue-600': $route.path.startsWith('/exams') }">
                                
                                <span class="relative z-10">Examens</span>
                            </router-link>
                            <router-link 
                                to="/orders"
                                class="relative px-8 py-2 overflow-hidden font-medium text-gray-700 transition-all duration-300 ease-in-out border-2 border-transparent rounded-lg hover:border-blue-600 hover:text-blue-600 hover:scale-10 hover:shadow-lg group"
                                :class="{ 'bg-blue-600': $route.path.startsWith('/orders') }">
                                <span class="relative z-10">Mes Commandes</span>    
                            </router-link>
                            <hr class="my-2">
                            <router-link to="/login" 
                                class="px-4 py-2 text-blue-600 transition-colors duration-200 border-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white"
                                @click="toggleMobile">
                                Se Conecter
                            </router-link>
                            <router-link to="/register" 
                                class="px-4 py-2 text-blue-600 transition-colors duration-200 border-2 border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white"
                                @click="toggleMobile">
                                S'inscrire
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { ref } from 'vue'

const isMobileMenuOpen = ref(false)

const toggleMobile = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value
}
</script>
