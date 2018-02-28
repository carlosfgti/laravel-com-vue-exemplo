import Vue from 'vue'
import VueRouter from 'vue-router'

import HomeComponent from '../components/pages/home/HomeComponent'
import ProductComponent from '../components/pages/products/ProductComponent'

Vue.use(VueRouter)

const routes = [
    {path: '/', component: HomeComponent, name: 'home'},
    {path: '/products', component: ProductComponent, name: 'products'},
]

const router = new VueRouter({
    routes
})

export default router