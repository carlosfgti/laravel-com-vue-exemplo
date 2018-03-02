import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routers.map'
import store from '../vuex/store'

Vue.use(VueRouter)

const router = new VueRouter({
    routes,
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.state.auth.authenticated) {
        return router.push({name: 'auth'})
    }

    if ( to.matched.some(record => record.meta.auth) &&  !store.state.auth.authenticated) {
        return router.push({name: 'auth'})
    }

    next()
})

export default router