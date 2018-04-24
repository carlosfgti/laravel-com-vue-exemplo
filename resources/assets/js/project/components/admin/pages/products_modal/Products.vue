<template>
    <div class="container">
        <h1>Produtos <span v-if="products.total > 0">({{ products.total }})</span></h1>

        <div class="row options">
            <div class="col">
                <a ref="modal" @click.prevent="create" class="btn btn-success">
                    Adicionar
                </a>
            </div>

            <div class="col">
                <search @search="searchProduct"></search>

                <div v-if="search">
                    Resultados para a pesquisa: {{ search }}
                </div>
            </div>
        </div>

        <table class="table table-dark">
            <tr>
                <th width="100">Imagem</th>
                <th>Nome</th>
                <th width="200">Ações</th>
            </tr>
            <tr v-for="(product, key) in products.data" :key="key">
                <td>
                  <div v-if="product.image">
                    <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
                  </div>
                </td>
                <td v-text="product.name"></td>
                <td>
                    <a href="#" @click.prevent="edit(product.id)" class="btn btn-info">
                        Editar
                    </a>
                    <a href="#" @click.prevent="confirmDelete(product)" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
        </table>

        <vodal :show="showModal" animation="zoom" @hide="hide" :width="600" :height="500">
            <form-product
                :product="product"
                :update="update"
                @success="success">
            </form-product>
        </vodal>

        <paginate
            :pagination="products"
            :offset="3"
            @paginate="loadProducts"></paginate>

    </div>
</template>

<script>
import Vodal from 'vodal'

import SearchProductComponent from './partials/SearchProductComponent'
import PaginationComponent from '../../../layouts/PaginationComponent'
import FormProductComponent from './partials/FormProductComponent'

export default {
    name: 'product-component',
    created () {
      this.loadProducts()
    },
    data () {
        return {
            search: null,
            productId: null,
            showModal: false,
            product: {
                id: '',
                name: '',
                description: '',
                image: '',
            },
            update: false,
        }
    },
    computed: {
      products () {
          return this.$store.state.products.items
      },
      params () {
          return {
              page: this.products.current_page,
              filter: this.search,
          }
      }
    },
    methods: {
        loadProducts (page = 1) {
            this.$store.dispatch('loadProducts', {...this.params, page})
        },
        edit (id) {
            this.reset()

            this.$store.dispatch('loadProduct', id)
                        .then(response => {
                            this.product = response
                            this.showModal = true
                            this.update = true
                        })
                        .catch(error => this.$snotify.error('Erro ao carregar produto'))
        },
        searchProduct (search) {
            this.search = search
            this.loadProducts()
        },
        confirmDelete (product) {
            this.productId = product.id

            this.$snotify.error(`Deseja realmente deletar o produto: ${product.name}`, product.name, {
                timeout: 10000,
                showProgressBar: true,
                closeOnClick: true,
                pauseOnHover: true,
                buttons: [
                    {text: 'Não', action: () => console.log('Clicked: No')},
                    {text: 'Sim', action: () => this.destroy(), bold: false},
                ]
            })
        },
        destroy () {
            this.$store.dispatch('destroyProduct', this.productId)
                            .then(() => {
                                this.productId = null
                                this.loadProducts()
                            })
        },
        create () {
            this.reset()
            this.update = false
            this.showModal = true
        },
        hide () {
            this.showModal = false
        },
        success () {
            this.reset()
            this.loadProducts()
            this.hide()
        },
        reset () {
            this.product = {
                id: '',
                name: '',
                description: '',
                image: '',
            }
        }
    },
    components: {
        search: SearchProductComponent,
        paginate: PaginationComponent,
        formProduct: FormProductComponent,
        Vodal,
    }
}
</script>


<style scoped>
.img-list{max-width: 50px;}
.options{margin: 20px 0;}
.vodal-dialog{height: auto; max-width: 90%;}
</style>
