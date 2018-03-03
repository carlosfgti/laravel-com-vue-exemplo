<template>
	<ul class="pagination">
	    <li v-if="pagination.current_page > 1">
        <a href="#" class="page-link" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
           <span aria-hidden="true">«</span>
        </a>
	    </li>

	    <li v-if="pagination.last_page > 1" v-for="(page, index) in pagesNumber" :class="['page-item', {'active': page == pagination.current_page}]" :key="index">
        <a href="#" class="page-link" @click.prevent="changePage(page)">
          {{ page }}
        </a>
      </li>

	    <li v-if="pagination.current_page < pagination.last_page">
	      <a href="#" class="page-link" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
	    </li>
    </ul>
</template>


<script>
  export default{
      props: {
        pagination: {
          type: Object,
          required: true
        },
        offset: {
          type: Number,
          default: 4
        }
    },
    computed: {
      pagesNumber() {
        // Verifica se tem itens para paginar, se não tiver retorna o Array vazio
        if (!this.pagination.to) {
          return [];
        }
        // Define a próxima página
        let from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        // Define a última opção páginação
        let to = from + this.offset;
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        // Cria as opções de paginação
        let pagesArray = [];
        for (let page = from; page <= to; page++) {
          pagesArray.push(page);
        }
        // Array montado com as opções de paginação (Número de opções de paginação === offset)
        return pagesArray;
      }
    },
    methods : {
      changePage(page) {
        // Dispara o evento @paginate do Component Pai
        this.$emit('paginate', page);
      }
    }
  }
</script>

<style scoped>
</style>
