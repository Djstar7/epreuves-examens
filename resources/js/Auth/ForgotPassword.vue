<template>
    <div class="flex items-center justify-center min-h-screen px-4 py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900">
                    Réinitialiser votre mot de passe
                </h2>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email" class="sr-only">Adresse email</label>
                        <input
                            id="email"
                            v-model="email"
                            type="email"
                            required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Adresse email"
                        />
                    </div>
                    <div v-if="isCodeSent">
                        <input
                            id="code"
                            v-model="verificationCode"
                            type="text"
                            required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Code de vérification"
                        />
                    </div>
                    <div v-if="isCodeVerified">
                        <input
                            id="password"
                            v-model="newPassword"
                            type="password"
                            required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Nouveau mot de passe"
                        />
                        <input
                            id="confirmPassword"
                            v-model="confirmPassword"
                            type="password"
                            required
                            class="relative block w-full px-3 py-2 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-none appearance-none rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Confirmer le mot de passe"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="relative flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md group hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        {{ buttonText }}
                    </button>
                </div>

                <div v-if="message" :class="['text-center', messageClass]">
                    {{ message }}
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const email = ref('')
const verificationCode = ref('')
const newPassword = ref('')
const confirmPassword = ref('')
const isCodeSent = ref(false)
const isCodeVerified = ref(false)
const message = ref('')
const messageClass = ref('text-green-600')

const buttonText = computed(() => {
    if (!isCodeSent.value) return 'Envoyer le code'
    if (!isCodeVerified.value) return 'Vérifier le code'
    return 'Réinitialiser le mot de passe'
})

const handleSubmit = async () => {
    try {
        if (!isCodeSent.value) {
            // Appel API pour envoyer le code de vérification
            // await axios.post('/api/send-reset-code', { email: email.value })
            isCodeSent.value = true
            message.value = 'Code de vérification envoyé'
            messageClass.value = 'text-green-600'
        } else if (!isCodeVerified.value) {
            // Appel API pour vérifier le code
            // await axios.post('/api/verify-code', { email: email.value, code: verificationCode.value })
            isCodeVerified.value = true
            message.value = 'Code vérifié avec succès'
            messageClass.value = 'text-green-600'
        } else {
            if (newPassword.value !== confirmPassword.value) {
                message.value = 'Les mots de passe ne correspondent pas'
                messageClass.value = 'text-red-600'
                return
            }
            // Appel API pour réinitialiser le mot de passe
            // await axios.post('/api/reset-password', {
            //   email: email.value,
            //   code: verificationCode.value,
            //   password: newPassword.value
            // })
            message.value = 'Mot de passe réinitialisé avec succès'
            messageClass.value = 'text-green-600'
        }
    } catch (error) {
        message.value = error.message || 'Une erreur est survenue'
        messageClass.value = 'text-red-600'
    }
}
</script>