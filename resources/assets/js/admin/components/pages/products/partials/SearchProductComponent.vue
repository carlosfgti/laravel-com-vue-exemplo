<template>
  <div>
      <form class="form form-inline" @submit.prevent="searchProducts">
          <input type="text" v-model="search" placeholder="Buscar?" class="form-control mr-sm-2">

          <button type="submit" class="btn btn-outline-success">Buscar</button>
      </form>
  </div>
</template>


<script>
export default {
  data () {
      return {
          search: ''
      }
  },
  methods: {
      searchProducts () {
          this.$emit('search', this.search)
      }
  }
}
</script>
