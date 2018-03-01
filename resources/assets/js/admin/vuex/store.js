import Vue from 'vue'
import Vuex from 'vuex'

import Product from './modules/products/products'
import preloader from './modules/preloader/preloader'
import auth from './modules/auth/auth'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        products: Product,
        preloader,
        auth,
    }
})