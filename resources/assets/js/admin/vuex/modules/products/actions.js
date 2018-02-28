import axios from 'axios'
import { URL_BASE } from '../../../configs/configs'

const RESOURCE = 'products'

export default {
    loadProducts (context) {
        // Inicia Preloader
        context.commit('LOADING', true)

        axios.get(`${URL_BASE}${RESOURCE}`)
                    .then(response => context.commit('PRODUCTS_LOAD', response.data))
                    .catch(error => console.log(error))
                    .finally(() => context.commit('LOADING', false))
    },


    addProduct (context, product) {
        context.commit('LOADING', true)

        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}`, product)
                    .then(response => resolve())
                    .catch(error => {
                        console.log(error)
                        reject(error.response.data.errors)
                    })
                    .finally(() => context.commit('LOADING', false))
        })
    },
}