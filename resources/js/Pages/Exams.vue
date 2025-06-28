<template>
    <div class="flex min-h-screen mt-16 bg-gray-100">
        <MenuExams />
        <!-- Right content for subjects -->
        <div class="flex-1 py-3 ml-65">
            <router-view />
        </div>
    </div>
</template>

<script setup>
import MenuExams from '../Layouts/MenuExams.vue'
</script>
