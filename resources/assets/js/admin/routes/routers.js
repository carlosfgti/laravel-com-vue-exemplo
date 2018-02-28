import Vue from 'vue'
import VueRouter from 'vue-router'

import HomeComponent from '../components/pages/home/HomeComponent'

Vue.use(VueRouter)

const routes = [
    {path: '/', component: HomeComponent, name: 'home'}
]

const router = new VueRouter({
    history: true,
    routes
})

export default router