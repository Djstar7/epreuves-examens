<template>
    <div class="min-h-screen bg-gray-50">
                <!-- Navbar -->
        <Header />
        <!-- Hero Section -->
        <section class="py-20 mt-8 bg-gradient-to-r from-blue-600 to-blue-800">
            <div class="container px-4 mx-auto">
                <div class="text-center">
                    <h1 class="mb-6 text-4xl font-bold text-white md:text-6xl">
                        Epreuves-Examens
                    </h1>
                    <p class="mb-8 text-xl text-blue-100">
                        Accédez à une large collection de sujets d'examens officiels pour votre réussite
                    </p>
                    <div class="flex justify-center gap-4">
                        <router-link to="exams" class="px-6 py-3 font-semibold text-blue-600 transition bg-white rounded-lg hover:bg-blue-50">
                            Parcourir les sujets
                        </router-link>
                        <button class="px-6 py-3 font-semibold text-white transition border-2 border-white rounded-lg hover:bg-blue-700">
                            En savoir plus
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-16">
            <div class="container px-4 mx-auto">
                <h2 class="mb-12 text-3xl font-bold text-center text-gray-800">
                    Catégories d'examens
                </h2>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div v-for="(category, index) in categories" :key="index" 
                             class="p-6 transition bg-white shadow-md rounded-xl hover:shadow-lg">
                        <div class="mb-4 text-blue-600">
                            <component :is="category.icon" class="w-12 h-12" />
                        </div>
                        <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ category.title }}</h3>
                        <p class="text-gray-600">{{ category.description }}</p>
                        <a :href="category.path" class="font-semibold text-blue-600 hover:text-blue-700">
                            Voir les sujets →
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Subjects Section -->
        <section class="py-16 bg-gray-100">
            <div class="container px-4 mx-auto">
                <h2 class="mb-12 text-3xl font-bold text-center text-gray-800">
                    Sujets récents
                </h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div v-for="(subject, index) in recentSubjects" :key="index"
                             class="overflow-hidden transition bg-white rounded-lg shadow-md hover:shadow-lg">
                        <div class="p-6">
                            <div class="mb-2 text-sm text-blue-600">{{ subject.category }}</div>
                            <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ subject.title }}</h3>
                            <p class="mb-4 text-gray-600">{{ subject.description }}</p>
                            <a href="#" class="font-semibold text-blue-600 hover:text-blue-700">
                                Voir le sujet →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="mt-4 text-white bg-slate-800">
            <div class="px-4 py-4 mx-auto max-w-7xl">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Section Logo -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-blue-400">Epreuves-Examens</h3>
                        <p class="text-gray-300">
                            Votre source fiable pour les sujets d'examens et ressources pédagogiques.
                        </p>
                    </div>

                    <!-- Section Liens Rapides -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-blue-400">Liens Rapides</h4>
                        <ul class="space-y-2">
                            <li>
                                <router-link to="/" class="text-gray-300 transition-colors hover:text-blue-400">
                                    Accueil
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/exams" class="text-gray-300 transition-colors hover:text-blue-400">
                                    Sujets d'Examens
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/contact" class="text-gray-300 transition-colors hover:text-blue-400">
                                    Contact
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- Section Contact -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-blue-400">Contact</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center space-x-2">
                                <i class="text-gray-300 fas fa-envelope"></i>
                                <span class="text-gray-300">contact@epreuves-examens.com</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="text-gray-300 fas fa-phone"></i>
                                <span class="text-gray-300">+xxx xx xx xx xx</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import Header from '../Layouts/Header.vue'

const categories = ref([
    {
        title: 'BEPC',
        description: 'Collection complète des sujets du BEPC',
        path: '/exams/'
    },
    {
        title: 'CAP',
        description: 'Collection complète des sujets du CAP',
        path: '/exams/cap'
    },
    {
        title: 'Probatoire',
        description: 'Sujets d\'examens du probatoire de toutes les séries',
        path: '/exams/probatoiregen'
    },
    {
        title: 'Baccalauréat',
        description: 'Sujets d\'examens du baccalauréat de toutes les séries',
        path: '/exams/baccgen'
    },

    {
        title: 'Concours',
        description: 'Sujets des différents concours administratifs',
        path: '/exams/concours'
    },
    {
        title: 'BTS',
        description: 'Sujets d\'examens du BTS de toutes les séries',
        path: '/exams/bts'
    },
])

const recentSubjects = ref([
    {
        title: 'Mathématiques Bac C 2023',
        category: 'Baccalauréat',
        description: 'Sujet officiel de mathématiques, série C, session 2023',
        image: '/images/math.jpg'
    },
    {
        title: 'Français BEPC 2023',
        category: 'BEPC',
        description: 'Épreuve de français du BEPC, session 2023',
        image: '/images/francais.jpg'
    },
    {
        title: 'Concours ENAM 2023',
        category: 'Concours',
        description: 'Sujet du concours d\'entrée à l\'ENAM 2023',
        image: '/images/concours.jpg'
    }
])
</script>