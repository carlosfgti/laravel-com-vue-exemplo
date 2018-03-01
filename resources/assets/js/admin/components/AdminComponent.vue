<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <ul class="nav navbar-nav navbar-right">
          <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
          <router-link class="nav-link" :to="{name: 'products'}">Produtos</router-link>
          <router-link class="nav-link" :to="{name: 'auth'}">Login</router-link>
        </ul>
      </div>
    </nav>

    <div class="spacing-custon">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  
}
</script>

<style>
.router-link-exact-active {color: #4bd02a !important;}
.spacing-custon{padding: 40px 0;}
</style>
