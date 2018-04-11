<template>
    <div class="container">
        <h1>Produtos <span v-if="products.total > 0">({{ products.total }})</span></h1>

        <div class="row options">
            <div class="col">
                <a ref="modal" @click.prevent="show" class="btn btn-success">
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
                    <a href="#" class="btn btn-info">
                        Editar
                    </a>
                    <a href="#" @click.prevent="confirmDelete(product)" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
        </table>

        <vodal :show="showModal" animation="zoom" @hide="hide" heigth=500>
            <form-product>
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
        loadProducts (page) {
            this.$store.dispatch('loadProducts', {...this.params, page})
        },
        searchProduct (search) {
            this.search = search

            this.loadProducts(1)
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
                                this.loadProducts(1)
                            })
        },
        show () {
            this.showModal = true
        },
        hide () {
            this.showModal = false
        },
        teste () {
            
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
.v--modal-overlay{padding: 10px;}
</style>
