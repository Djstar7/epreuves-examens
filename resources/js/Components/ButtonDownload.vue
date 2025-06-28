<template>
    <button @click="downloadExam" 
            class="flex items-center justify-center flex-1 px-4 py-3 font-medium text-white transition-colors bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Télécharger
    </button>
</template>
<script setup>
const emit = defineEmits(['downloadFile'])

const downloadExam = () => {
    // Telechargement ici
}
</script>



