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
}