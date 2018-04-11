<template>
    <div class="padding-default">
      <form @submit.prevent="onSubmit">
        <div :class="['form-group', {'has-error': errors.image}]">
            <picture-input
                ref="pictureInput"
                @change="onChanged"
                @remove="onRemoved"
                :width="200"
                :removable="true"
                removeButtonClass="btn btn-danger"
                :height="200"
                accept="image/jpeg, image/png, image/gif"
                buttonClass="btn btn-primary"
                :customStrings="{
                upload: '<h1>Upload</h1>',
                drag: 'Clique ou arraste para aqui'}">
            </picture-input>
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
import PictureInput from 'vue-picture-input'

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
            upload: null,
        }
    },
    methods: {
        onChanged() {
            console.log("New picture loaded");
            if (this.$refs.pictureInput.file) {
                this.upload = this.$refs.pictureInput.file;
            } else {
                console.log("Old browser. No support for Filereader API");
            }
        },
        onRemoved() {
            this.upload = null;
        },
        onSubmit () {
            const action = this.update ? 'editProduct' : 'addProduct'

            const formData = new FormData()
            if (this.upload != null)
                formData.append('image', this.upload)
            
            formData.append('id', this.product.id)
            formData.append('name', this.product.name)
            formData.append('description', this.product.description)

            return this.$store.dispatch(action, formData)
                        .then(() => {
                            this.$swal({
                                title: 'Sucesso',
                                text: 'Operação realizada com sucesso!',
                                icon: 'success',
                            })

                            this.$emit('success')
                        })
                        .catch(errors => {
                            this.$snotify.error('Algo errado...', 'Erro')

                            this.errors = errors.hasOwnProperty('errors') ? errors.errors : errors
                        })
        }
    },
    components: {
        PictureInput
    }
}
</script>

<style>
form{
    margin: 10px 0;
}
.img-responsive{max-width: 60px;}
.padding-default{padding: 10px;}
</style>
