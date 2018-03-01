import axios from 'axios'
import { URL_BASE } from '../../../configs/configs'
import { NAME_TOKEN } from '../../../configs/configs'

const RESOURCE = 'auth/'

const state = {
    me: {},
    authenticated: false
}

const mutations = {
    AUTH_USER_OK (state, user) {
        state.me = user
        state.authenticated = true
    },
    AUTH_USER_FAIL (state) {
        state.me = {},
        state.authenticated = false
    }
}

const actions = {
    login (context, formData) {
        context.commit('LOADING', true)

        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}`, formData)
                        .then(response => {
                            context.commit('AUTH_USER_OK', response.data.user)

                            localStorage.setItem(NAME_TOKEN, response.data.token)

                            resolve()
                        })
                        .catch(error => {
                            console.log(error.response)

                            reject(error.response.data)
                        })
                        .finally(() => context.commit('LOADING', false))
        })
    },

    logout (context) {
        localStorage.removeItem(NAME_TOKEN)
        context.commit('AUTH_USER_FAIL')
    }
}

export default {
    state,
    mutations,
    actions
}