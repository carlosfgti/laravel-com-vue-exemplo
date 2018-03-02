<template>
    <div class="container">
        <h1>Login</h1>
        <hr>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card card-default">
                    <div class="card-header">
                        Entrar
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" v-if="error" v-text="error"></div>

                        <form @submit.prevent="login" class="form">
                            <div class="form-group" :class="{ 'has-error': errors.email }">
                                <input type="email" v-model="formData.email" class="form-control" placeholder="E-mail">
                                <div class="help-block" v-if="errors.email">
                                    <div v-for="(error, index) in errors.email" :key="index">
                                        <strong>{{ error }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.email }">
                                <input type="password" v-model="formData.password" class="form-control" placeholder="Senha">
                                <div v-for="(error, index) in errors.password" :key="index">
                                    <strong>{{ error }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Entrar</button>
                            </div>
                        </form><!--Form-->
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--col-->
        </div><!--row-->
    </div>
</template>


<script>
export default {
  data () {
      return {
          formData: {
              email: '',
              password: '',
          },
          errors: {},
          error: ''
      }
  },
  methods: {
      login () {
          this.$store.dispatch('login', this.formData)
                    .then(() => {
                        this.$snotify.success('Sucesso ao logar', 'OK')

                        this.$router.push({name: 'dashboard'})
                    })
                    .catch((response) => {
                        console.log(response)
                        this.error = response.error
                        this.$snotify.error('Falha...', 'Erro')
                    })
      }
  }
}
</script>
