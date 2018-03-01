import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routers.map'
import store from '../vuex/store'

Vue.use(VueRouter)

const router = new VueRouter({
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.state.auth.authenticated) {
        router.push({name: 'auth'})
    }

    next()
})

export default router