<template>
    <!-- Left menu for education levels -->
        <div class="fixed top-0 left-0 flex flex-col w-64 h-screen pt-24 bg-white rounded-lg shadow-lg">
            <!-- Fixed header -->
            <h3 class="px-6 py-4 text-2xl font-extrabold text-center text-gray-800 border-b-2 border-blue-500">
                <span class="text-transparent bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text">
                    Examens Officiels
                </span>
            </h3>
            
            <!-- Scrollable content -->
            <div class="flex-1 pb-4 overflow-y-auto">
                <!-- Enseignement Général -->
                <div class="p-3">
                    <h4 class="mb-2 text-lg font-semibold text-gray-700">Enseignement Général</h4>
                    <div class="flex flex-col space-y-2">
                        <router-link 
                            v-for="level in generalEducation" 
                            :key="level.name"
                            :to="level.path"
                            :class="{
                                'cursor-pointer p-3 rounded-xl transition-colors flex items-center': true,
                                'bg-blue-500 text-white': $route.name === level.name,
                                'hover:bg-gray-100 text-gray-700': $route.name !== level.name
                            }"
                        >
                            <span>{{ level.title }}</span>
                        </router-link>
                    </div>
                </div>

                <!-- Enseignement Technique -->
                <div class="p-3 border-t border-gray-200">
                    <h4 class="mb-2 text-lg font-semibold text-gray-700">Enseignement Technique</h4>
                    <div class="flex flex-col space-y-2">
                        <router-link 
                            v-for="level in technicalEducation" 
                            :key="level.name"
                            :to="level.path"
                            :class="{
                                'cursor-pointer p-3 rounded-xl transition-colors flex items-center': true,
                                'bg-blue-500 text-white': $route.name === level.name,
                                'hover:bg-gray-100 text-gray-700': $route.name !== level.name
                            }"
                        >
                            <span>{{ level.title }}</span>
                        </router-link>
                    </div>
                </div>
                <!-- Autres Formations -->
                <div class="p-3 border-t border-gray-200">
                    <h4 class="mb-2 text-lg font-semibold text-gray-700">Autres Formations</h4>
                    <div class="flex flex-col space-y-2">
                        <router-link 
                            v-for="level in otherEducation" 
                            :key="level.name"
                            :to="level.path"
                            :class="{
                                'cursor-pointer p-3 rounded-xl transition-colors flex items-center': true,
                                'bg-blue-500 text-white': $route.name === level.name,
                                'hover:bg-gray-100 text-gray-700': $route.name !== level.name
                            }"
                        >
                            <span>{{ level.title }}</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
</template>
<script setup>
import { ref } from 'vue'
const generalEducation = ref([
    { name: 'bepc', path: '/exams/', title: 'Brevet (BEPC)' },
    { name: 'probatoiregen', path: '/exams/probatoiregen', title: 'Probatoire' },
    { name: 'baccaleuratgen', path: '/exams/baccgen', title: 'Baccalauréat' },
])

const technicalEducation = ref([
    { name: 'cap', path: '/exams/cap', title: 'Certificat (CAP)' },
    { name: 'probatoiretech', path: '/exams/probatoiretech', title: 'Probatoire' },
    { name: 'baccaleurattech', path: '/exams/bacctech', title: 'Baccalauréat' },
])

const otherEducation = ref([
    { name: 'bts', path: '/exams/bts', title: 'BTS' },
    { name: 'concours', path: '/exams/concours', title: 'Concours' },
])
</script>