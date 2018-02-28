// Recupera o arquivo com as configurações iniciais do projeto
require('./bootstrap')
window.Vue = require('vue')

import router from './routes/routers'
import store from './vuex/store'

/**
 * Cria os componentes
 */
Vue.component('admin-component', require('./components/AdminComponent.vue'))
Vue.component('preloader-component', require('./components/layouts/PreloaderComponent'))


// Instância do Vue JS, e seletor
const app = new Vue({
    router,
    store,
    el: '#app',
})
