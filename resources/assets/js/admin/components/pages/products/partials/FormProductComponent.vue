<template>
    <div>
      <form @submit.prevent="onSubmit">
        <div :class="['form-group', {'has-error': errors.image}]">
            <img :src="imagePreview" class="img-responsive">
            <input type="file" v-on:change="onFileChange" class="form-control">
            <div v-if="errors.image" class="help-block">
                <p>{{ errors.image[0] }}</p>
            </div>
        </div>

        <div :class="['form-group', {'has-error': errors.name}]">
            <input type="text" class="form-control" placeholder="Nome Tarefa" v-model="product.name">
            <div v-if="errors.name" class="help-block">
                <p>{{ errors.name[0] }}</p>
            </div>
        </div>

        <div :class="['form-group', {'has-error': errors.description}]">
            <input type="text" class="form-control" placeholder="Descrição" v-model="product.description">
            <div v-if="errors.description" class="help-block">
                <p>{{ errors.description[0] }}</p>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</template>

<script>
export default {
    props: {
        update: {
            require: false,
            type: Boolean,
            default: false
        },
        product: {
            require: false,
            type: Array|Object,
            default: () => {
                return {
                    id: '',
                    name: '',
                    description: '',
                    image: '',
                }
            }
        }
    },
    data () {
        return {
            errors: {},
            imagePreview: null,
        }
    },
    methods: {
        onFileChange (e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0])
        },
        createImage (file) {
            let reader = new FileReader()
            reader.onload = (e) => {
                this.product.image = e.target.result
                this.imagePreview = e.target.result
            }
            reader.readAsDataURL(file)
        },
        onSubmit () {
            const action = this.update ? 'editProduct' : 'addProduct'

            return this.$store.dispatch(action, this.product)
                        .then(() => {
                            this.$snotify.success('Sucesso ao salvar o registro', {
                                timeout: 4000,
                                showProgressBar: true,
                                closeOnClick: true,
                                pauseOnHover: true
                            })

                            this.$router.push({name: 'products'})
                        })
                        .catch(errors => {
                            this.$snotify.error('Algo errado...', 'Erro')

                            this.errors = errors.hasOwnProperty('errors') ? errors.errors : errors
                        })
        }
    }
}
</script>

<style>
form{
    margin: 10px 0;
}
.img-responsive{max-width: 60px;}
</style>
