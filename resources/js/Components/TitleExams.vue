<template>
    <div class="p-4 mt-8 text-center text-white bg-blue-500 rounded-lg shadow-lg mb-14">
        <h1 class="mb-4 text-4xl font-bold">
            {{ head }}
        </h1>
        <div class="mt-4 text-sm">{{ message }}</div>
    </div>
</template>
<script setup>
defineProps({
    head: String,
    message: String
})
</script>