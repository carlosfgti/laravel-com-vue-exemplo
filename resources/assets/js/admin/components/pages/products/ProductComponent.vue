<template>
    <div class="container">
        <h1>Produtos Cadastrados</h1>

        <div class="row options">
            <div class="col">
                #add
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
                    <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
                </td>
                <td v-text="product.name"></td>
                <td>
                    <a href="#" class="btn btn-danger">Editar</a>
                    <a href="#" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
        </table>


    </div>
</template>

<script>
export default {
    name: 'product-component',
    data () {
        return {
        }
    },
    computed: {
      products () {
          return this.$store.state.products.items
      },
    }
}
</script>


<style scoped>
.img-list{max-width: 50px;}
</style>
