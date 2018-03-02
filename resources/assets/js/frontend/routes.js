import Vue from 'vue'
import VueRouter from 'vue-router'

import HomePage from './pages/home/HomePageComponent'
import SiteComponent from './components/SiteComponent'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: SiteComponent,
        children: [
            {path: '/', component: HomePage, name: 'site.name'},
        ]
    }
]