import Vue from 'vue'
import VueRouter from 'vue-router'

import HomeComponent from '../components/pages/home/HomeComponent'
import ProductComponent from '../components/pages/products/ProductComponent'
import LoginComponent from '../components/pages/auth/LoginComponent'
import ProductAddComponent from '../components/pages/products/ProductAddComponent'
import ProductEditComponent from '../components/pages/products/ProductEditComponent'
import Page404 from '../components/pages/404/Page404'

Vue.use(VueRouter)

const routes = [
    {path: '/', component: HomeComponent, name: 'home'},
    {path: '/login', component: LoginComponent, name: 'auth'},
    {path: '/products', component: ProductComponent, name: 'products'},
    {path: '/product/add', component: ProductAddComponent, name: 'product.add'},
    {path: '/product/:id/edit', component: ProductEditComponent, name: 'product.edit', props: true},
    {path: '*', component: Page404},
]

const router = new VueRouter({
    routes
})

export default router