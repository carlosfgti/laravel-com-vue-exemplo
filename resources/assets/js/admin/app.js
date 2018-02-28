// Recupera o arquivo com as configurações iniciais do projeto
require('./bootstrap')
window.Vue = require('vue')

/**
 * Cria os componentes
 */
Vue.component('admin-component', require('./components/AdminComponent.vue'))


// Instância do Vue JS, e seletor
const app = new Vue({
    el: '#app'
})
