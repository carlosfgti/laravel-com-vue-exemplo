<template>
    <div>
        <h1>Login</h1>

        <div class="alert alert-warning" v-if="error" v-text="error"></div>

        <form @submit.prevent="login" class="form">
            <div class="form-group" :class="{ 'has-error': errors.email }">
                <input type="email" v-model="auth.email" class="form-control" placeholder="E-mail">
                <div class="help-block" v-if="errors.email">
                    <div v-for="(error, index) in errors.email" :key="index">
                        <strong>{{ error }}</strong>
                    </div>
                </div>
            </div>
            <div class="form-group" :class="{ 'has-error': errors.email }">
                <input type="password" v-model="auth.password" class="form-control" placeholder="Senha">
                <div v-for="(error, index) in errors.password" :key="index">
                    <strong>{{ error }}</strong>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Entrar</button>
            </div>
        </form>
    </div>
</template>


<script>
export default {
  data () {
      return {
          auth: {
              email: '',
              password: '',
          },
          errors: {},
          error: ''
      }
  },
  methods: {
      login () {
          
      }
  }
}
</script>
