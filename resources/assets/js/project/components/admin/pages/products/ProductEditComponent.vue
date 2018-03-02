<template>
    <div class="container">
        <h1>Editar Produto <b>{{product.name}}</b></h1>

        <form-product-component
            :product="product"
            :update="true">
        </form-product-component>
    </div>
</template>

<script>
import FormProductComponent from './partials/FormProductComponent'

export default {
    props: {
        id: {
            require: true
        }
    },
    created () {
        this.$store.dispatch('loadProduct', this.id)
                        .then(response => this.product = response)
                        .catch(error => {
                            this.$snotify.error('Erro ao carregar produto', 'Erro')
                        })
    },
    data () {
        return {
            product: {}
        }
    },
    components: {
        FormProductComponent
    }
}
</script>
