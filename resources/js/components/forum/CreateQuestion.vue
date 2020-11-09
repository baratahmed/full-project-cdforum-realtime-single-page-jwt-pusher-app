<template>
     <v-container>
         <span class="red--text" v-if="errors.question_title">{{errors.question_title[0]}}</span>
        <v-form @submit.prevent="storeQuestion">
            <v-text-field
            v-model="form.question_title"
            label="Title"
            type="text"
            required
        ></v-text-field>

        <span class="red--text" v-if="errors.category_id">{{errors.category_id[0]}}</span>
        
        <v-select
          :items="categories"
          v-model="form.category_id"
          item-text="category_name"
          item-value="id"
          label="Category"          
        ></v-select>

        <span class="red--text" v-if="errors.question_body">{{errors.question_body[0]}}</span>

        <vue-simplemde v-model="form.question_body" ref="markdownEditor" />

        <v-btn color="green" type="submit" :disabled="disabled">
             Create
        </v-btn>

    </v-form>
    </v-container>
</template>

<style scoped>

</style>

<script>

    export default {
        data(){
            return{
                form:{
                    question_title:null,
                    question_body:null,
                    category_id:null,
                },
                categories:{},
                errors:{},
            }
        },

        created(){
            axios.get('api/category')
            .then(res => this.categories = res.data.data)
            .catch(err => console.log(err.response.data))
        },
        computed:{
            disabled(){
                return !(this.form.question_title && this.form.question_body && this.form.category_id)
            }
        },

        methods:{
            storeQuestion(){
                axios.post('api/question',this.form)
                .then(res => this.$router.push(res.data.question_path))
                .catch(error => this.errors = error.response.data.errors)
            }
        }
    }
</script>
