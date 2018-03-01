<template>
  <div>
      <ul class="nav nav-pills nav-stacked">
        <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
        <router-link class="nav-link" :to="{name: 'products'}">Produtos</router-link>
        <router-link class="nav-link" :to="{name: 'auth'}">Login</router-link>
      </ul>

      <router-view></router-view>
  </div>
</template>

<script>
export default {
  
}
</script>

<style>
.router-link-exact-active {
    background: #cecece;
    color: #000;
    border-radius: 0 !important;
}
</style>
