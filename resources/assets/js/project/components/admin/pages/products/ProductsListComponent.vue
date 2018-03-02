<template>
    <div class="container">
        <h1>Produtos <span v-if="products.total > 0">({{ products.total }})</span></h1>

        <div class="row options">
            <div class="col">
                <router-link :to="{name: 'product.add'}" class="btn btn-success">
                    Adicionar
                </router-link>
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
                    <router-link :to="{name: 'product.edit', params: {id: product.id}}" class="btn btn-success">
                        Editar
                    </router-link>
                    <a href="#" @click.prevent="confirmDelete(product)" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
        </table>

        <paginate
            :pagination="products"
            :offset="3"
            @paginate="loadProducts"></paginate>


    </div>
</template>

<script>
import SearchProductComponent from './partials/SearchProductComponent'
import PaginationComponent from '../../../layouts/PaginationComponent'

export default {
    name: 'product-component',
    created () {
      this.loadProducts()
    },
    data () {
        return {
            search: null,
            productId: null,
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
        }
    },
    components: {
        search: SearchProductComponent,
        paginate: PaginationComponent
    }
}
</script>


<style scoped>
.img-list{max-width: 50px;}
.options{margin: 20px 0;}
</style>
