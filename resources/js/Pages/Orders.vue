<template>
    <div class="min-h-screen py-8 bg-gray-100">
        <div class="w-full max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-semibold text-gray-900">Mes Commandes</h1>
            
            <!-- Liste des commandes -->
            <div class="bg-white divide-y divide-gray-200 rounded-lg shadow-sm">
                <div v-if="orders.length === 0" class="p-6 text-center text-gray-500">
                    Aucune commande trouvée
                </div>
                
                <div v-for="order in orders" :key="order.id" class="p-6 hover:bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">
                                Commande #{{ order.id }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Passée le {{ formatDate(order.created_at) }}
                            </p>
                        </div>
                        <span :class="[
                            'px-3 py-1 rounded-full text-sm font-medium',
                            getStatusClass(order.status)
                        ]">
                            {{ order.status }}
                        </span>
                    </div>
                    
                    <div class="pt-4 mt-4 border-t border-gray-100">
                        <div class="flow-root">
                            <ul class="-my-5">
                                <li v-for="item in order.items" :key="item.id" class="py-5">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img :src="item.image" alt="Product" class="object-cover w-16 h-16 rounded">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ item.name }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Quantité: {{ item.quantity }}
                                            </p>
                                        </div>
                                        <div class="flex-shrink-0 text-sm font-medium text-gray-900">
                                            {{ formatPrice(item.price) }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-6">
                        <p class="text-sm text-gray-500">
                            {{ order.items.length }} article(s)
                        </p>
                        <p class="text-lg font-medium text-gray-900">
                            Total: {{ formatPrice(order.total) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const orders = ref([])

const getStatusClass = (status) => {
    const classes = {
        'en-cours': 'bg-yellow-100 text-yellow-800',
        'livré': 'bg-green-100 text-green-800',
        'annulé': 'bg-red-100 text-red-800'
    }
    return classes[status] || 'bg-gray-100 text-gray-800'
}

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    })
}

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price)
}

onMounted(async () => {
    try {
        // Simule un appel API - À remplacer par votre vrai appel API
        orders.value = [
            {
                id: 1,
                created_at: '2023-05-20',
                status: 'en-cours',
                items: [
                    {
                        id: 1,
                        name: 'Produit exemple',
                        quantity: 2,
                        price: 29.99,
                        image: 'https://via.placeholder.com/150'
                    }
                ],
                total: 59.98
            }
        ]
    } catch (error) {
        console.error('Erreur lors du chargement des commandes:', error)
    }
})
</script>""