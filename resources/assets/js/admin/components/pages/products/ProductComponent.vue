<template>
    <div class="container">
        <h1>Produtos Cadastrados</h1>

        <div class="row options">
            <div class="col">
                <router-link :to="{name: 'product.add'}" class="btn btn-success">
                    Adicionar
                </router-link>
            </div>

            <div class="col">
                #search
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
                    <a href="#" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
        </table>

        <div class="text-right" v-if="products.last_page > 1">
            <ul class="pagination">
                <li v-for="page in products.last_page" :key="page" :class="['page-item', {active: page == products.current_page}]">
                    <a href="#" @click.prevent="loadProducts(page)" class="page-link">{{ page }}</a>
                </li>
            </ul>
        </div>


    </div>
</template>

<script>
export default {
    name: 'product-component',
    created () {
      this.loadProducts()
    },
    data () {
        return {
        }
    },
    computed: {
      products () {
          return this.$store.state.products.items
      },
      params () {
          return {
              page: this.products.current_page,
          }
      }
    },
    methods: {
        loadProducts (page) {
            this.$store.dispatch('loadProducts', {...this.params, page})
        }
    }
}
</script>


<style scoped>
.img-list{max-width: 50px;}
</style>
