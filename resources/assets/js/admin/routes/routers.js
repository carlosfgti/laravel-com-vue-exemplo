import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routers.map'

Vue.use(VueRouter)

const router = new VueRouter({
    routes
})

export default router