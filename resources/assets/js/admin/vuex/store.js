import Vue from 'vue'
import Vuex from 'vuex'

import Product from './modules/products/products'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        products: Product
    }
})