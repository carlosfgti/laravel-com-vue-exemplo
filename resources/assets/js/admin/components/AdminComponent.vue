<template>
  <div>
      <ul>
        <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
        <router-link class="nav-link" :to="{name: 'products'}">Produtos</router-link>
      </ul>

      <router-view></router-view>
  </div>
</template>

<script>
export default {
  
}
</script>

<style>

</style>
