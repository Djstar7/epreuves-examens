<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">  
            <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Inscription</h2>
            <form @submit.prevent="handleSubmit">
                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="block w-full px-4 py-2 mt-1 border rounded-md"
                        placeholder="Entrer votre nom"
                    />
                    <p v-if="errorName" class="mt-2 text-red-600">{{ errorName }}</p>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        class="block w-full px-4 py-2 mt-1 border rounded-md"
                        placeholder="Entrer votre email"
                    />
                    <p v-if="errorMail" class="mt-2 text-red-600">{{ errorMail }}</p>
                </div>

                <!-- Numero de telephone -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telephone</label>
                    <input
                        id="phone"
                        v-model="form.phone"
                        type="number"
                        autocomplete="new-phone"
                        class="block w-full px-4 py-2 mt-1 border rounded-md"
                        placeholder="Entrer votre numero de telephone"
                    />
                    <p v-if="errorPhone" class="mt-2 text-red-600">{{ errorPhone }}</p>
                </div>

                <!-- Mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="new-password"
                        class="block w-full px-4 py-2 mt-1 border rounded-md"
                        placeholder="Entrer votre mot de passe"
                    />
                    <p v-if="errorPass" class="mt-2 text-red-600">{{ errorPass }}</p>
                </div>

                <!-- Confirmation -->
                <div class="mb-6">
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirmer mot de passe</label>
                    <input
                        id="confirm-password"
                        v-model="form.confirmPassword"
                        type="password"
                        autocomplete="new-password"
                        class="block w-full px-4 py-2 mt-1 border rounded-md"
                        placeholder="Confirmer votre mot de passe"
                    />
                    <p v-if="errorPass" class="mt-2 text-red-600">{{ errorPass }}</p>
                </div>

                <button
                    type="submit"
                    class="w-full py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700"
                >
                    S'inscrire
                </button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Vous avez déjà un compte ?
                <router-link to="/login" class="text-blue-600 hover:underline">Se Connecter</router-link>
            </p>
            <p v-if="error" class="mt-2 text-red-600">{{ error }}</p>
            <p v-if="success" class="mt-2 text-green-500">{{ success }}</p>
            <p class="mt-4 text-sm text-center text-gray-600">
                <router-link to="/" class="text-blue-500">
                    <svg class="inline-block w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2a1 1 0 011 1v2h2a1 1 0 110 2h-2v2h2a1 1 0 110 2h-2v2h2a1 1 0 110 2h-2v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H9a1 1 0 110-2h2v-2H9a1 1 0 110-2h2v-2H9a1 1 0 110-2h2V7H9a1 1 0 110-2h2V3a1 1 0 011-1z"/>
                    </svg>
                    Retour à l'accueil
                </router-link>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = ref({
    name: '',
    email: '',
    phone: '',
    password: '',
    confirmPassword: ''
})
const error = ref(null)
const errorName = ref(null)
const errorMail = ref(null)
const errorPhone = ref(null)
const errorPass = ref(null)
const success = ref(null)
const isLoading = ref(false)

const handleSubmit = async () => {
    error.value = null
    success.value = null

    // 1. Validation
    if (!form.value.name || !form.value.email || !form.value.phone || !form.value.password || !form.value.confirmPassword) {
        error.value = 'Tous les champs sont obligatoires.'
        return
    }
    if (!/^[A-Za-z\s]+$/.test(form.value.name)) {
        errorName.value = 'Le nom ne doit contenir que des lettres.'
        return
    }
    if (!/\S+@\S+\.\S+/.test(form.value.email)) {
        errorMail.value = 'Adresse email invalide.'
        return
    }
    if(!/^6[0-9]{8}$/.test(form.value.phone)){
        errorPhone.value = 'Numero de telephone invalide.'
        return
    }
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/.test(form.value.password)) {
        errorPass.value = 'Le mot de passe doit contenir 8 caractères, dont 1 majuscule, 1 minuscule et 1 chiffre.'
        return
    }
    if (form.value.password !== form.value.confirmPassword) {
        error.value = 'Les mots de passe ne correspondent pas.'
        return
    }


    try {
        console.log("Soumission du formulaire...")

        const res = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: form.value.name,
                email: form.value.email,
                phone: form.value.phone,
                password: form.value.password
            })
        })
        let result = {}
        if (!res.ok) {
            try {
                result = await res.json()
            } catch {
                const txt = await res.text()
                throw new Error(`Erreur ${res.status}: ${txt}`)
            }

            if (res.status === 422 && result.errors) {
                throw new Error(Object.values(result.errors).flat().join(' '))
            }

            throw new Error(result.message || `Erreur inattendue (${res.status})`)
        }

        result = await res.json()
        success.value = result.message || 'Inscription réussie !'
        // Redirection (facultative) après un court délai :
        setTimeout(() => router.push('/login'), 1500)
    } catch (err) {
        error.value = err.message
        console.error('Register failed:', err)
    }
}
</script>
