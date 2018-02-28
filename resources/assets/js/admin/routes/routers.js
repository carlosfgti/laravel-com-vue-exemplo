import Vue from 'vue'
import VueRouter from 'vue-router'

import HomeComponent from '../components/pages/home/HomeComponent'
import ProductComponent from '../components/pages/products/ProductComponent'
import LoginComponent from '../components/pages/auth/LoginComponent'

Vue.use(VueRouter)

const routes = [
    {path: '/', component: HomeComponent, name: 'home'},
    {path: '/login', component: LoginComponent, name: 'auth'},
    {path: '/products', component: ProductComponent, name: 'products'},
]

const router = new VueRouter({
    routes
})

export default router