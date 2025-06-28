import{ createRouter, createWebHistory } from 'vue-router'
import Home from '../Pages/Home.vue'
import Contact from '../Pages/Contact.vue'
import Exams from '../Pages/Exams.vue'
import Orders from '../Pages/Orders.vue'

//Sous chemin de exams dans genral
import Bepc from '../Pages/LevelExams/General/Bepc.vue'
import ProbatoireGen from '../Pages/LevelExams/General/Probatoire.vue'
import BaccaleuratGen from '../Pages/LevelExams/General/Baccaleurat.vue'

//Sous chemin de exams dans technics
import Cap from '../Pages/LevelExams/Technics/Cap.vue'
import ProbatoireTech from '../Pages/LevelExams/Technics/Probatoire.vue'
import BaccaleuratTech from '../Pages/LevelExams/Technics/Baccaleurat.vue'


import Concours from '../Pages/LevelExams/Concours.vue'
import Bts from '../Pages/LevelExams/Bts.vue'

import Login from '../Auth/Login.vue'
import Logout from '../Auth/Logout.vue'
import Register from '../Auth/Register.vue'


const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/exams',
        name: 'exams',
        component: Exams,
        children: [
            {path: '/exams/', name: 'bepc', component: Bepc},
            {path: '/exams/probatoiregen', name: 'probatoiregen', component: ProbatoireGen},
            {path: '/exams/baccgen', name: 'baccaleuratgen', component: BaccaleuratGen},


            {path: '/exams/cap', name: 'cap', component: Cap},
            {path: '/exams/probatoiretech', name: 'probatoiretech', component: ProbatoireTech},
            {path: '/exams/bacctech', name: 'baccaleurattech', component: BaccaleuratTech},


            {path: '/exams/concours', name: 'concours', component: Concours},
            {path: '/exams/bts', name: 'bts', component: Bts},
        ],
        meta: {requiresAuth: true}
    },
    {
        path: '/orders',
        name: 'orders',
        component: Orders,
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
    },

    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


// ⬇️ Place ce guard **juste après** la création du router
// 👇 guard globale
router.beforeEach((to, from, next) => {

    if (to.meta.requiresAuth ) {
        // on se souvient de la route et on bascule sur /login
        return next({
            path: '/login',
            query: { redirect: to.fullPath }
        })
    }
    next()
})

export default router