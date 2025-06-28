<template>
    <div class="min-h-screen px-4 py-12 mt-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="max-w-3xl p-8 mx-auto bg-white rounded-lg shadow-md">
            <h1 class="mb-2 text-3xl font-bold text-center text-gray-800">Contactez-nous</h1>
            <p class="mb-8 text-center text-gray-600">
                Une question sur les examens ? N'hésitez pas à nous contacter !
            </p>

            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input
                        type="text"
                        id="name"
                        v-model="form.name"
                        required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Votre nom"
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        v-model="form.email"
                        required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="votre@email.com"
                    >
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                    <select
                        id="subject"
                        v-model="form.subject"
                        required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        <option value="">Sélectionnez un sujet</option>
                        <option value="question">Question sur un examen</option>
                        <option value="suggestion">Suggestion d'amélioration</option>
                        <option value="problem">Signalement d'un problème</option>
                        <option value="other">Autre</option>
                    </select>
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea
                        id="message"
                        v-model="form.message"
                        rows="5"
                        required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Votre message ici..."
                    ></textarea>
                </div>

                <button
                    type="submit"
                    :disabled="sending"
                    class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:bg-blue-300 disabled:cursor-not-allowed"
                >
                    {{ sending ? 'Envoi en cours...' : 'Envoyer' }}
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const sending = ref(false)
const form = reactive({
    name: '',
    email: '',
    subject: '',
    message: ''
})

const submitForm = async () => {
    sending.value = true
    try {
        // Implémentez ici votre logique d'envoi
        await sendContactForm(form)
        alert('Message envoyé avec succès!')
        resetForm()
    } catch (error) {
        alert('Erreur lors de l\'envoi du message. Veuillez réessayer.')
    } finally {
        sending.value = false
    }
}

const resetForm = () => {
    form.name = ''
    form.email = ''
    form.subject = ''
    form.message = ''
}

const sendContactForm = async (formData) => {
    // Implémentez ici votre appel API
    // Exemple: await axios.post('/api/contact', formData)
}
</script>
