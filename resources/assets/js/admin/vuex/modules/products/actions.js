import axios from 'axios'
import { URL_BASE } from '../../../configs/configs'

const RESOURCE = 'products/'

export default {
    loadProducts (context, params) {
        // Inicia Preloader
        context.commit('LOADING', true)

        axios.get(`${URL_BASE}${RESOURCE}`, {params})
                    .then(response => context.commit('PRODUCTS_LOAD', response.data))
                    .catch(error => console.log(error))
                    .finally(() => context.commit('LOADING', false))
    },


    loadProduct (context, id) {
        context.commit('LOADING', true)

        return new Promise((resolve, reject) => {
            axios.get(`${URL_BASE}${RESOURCE}${id}`)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error))
                    .finally(() => context.commit('LOADING', false))
        })
    },


    addProduct (context, product) {
        context.commit('LOADING', true)

        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}`, product)
                    .then(response => resolve())
                    .catch(error => reject(error.response.data.errors))
                    .finally(() => context.commit('LOADING', false))
        })
    },


    editProduct (context, product) {
        context.commit('LOADING', true)

        return new Promise((resolve, reject) => {
            axios.put(`${URL_BASE}${RESOURCE}${product.id}`, product)
                    .then(response => resolve())
                    .catch(error => reject(error.response.data))
                    .finally(() => context.commit('LOADING', false))
        })
    },


    destroyProduct (context, id) {
        context.commit('LOADING', true)

        return new Promise((resolve, reject) => {
            axios.delete(`${URL_BASE}${RESOURCE}${id}`)
                    .then(response => resolve())
                    .catch(error => reject(error.response.data))
                    .finally(() => context.commit('LOADING', false))
        })
    },
}