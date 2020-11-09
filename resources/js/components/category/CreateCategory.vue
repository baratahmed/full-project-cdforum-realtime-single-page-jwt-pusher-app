<template>
     <v-container>
         <v-alert
            v-if="errors"
            color="red"
            dismissible
            elevation="10"
            
            type="success"
            >
            Please Give a Category Name
            </v-alert>

        <v-form @submit.prevent="storeCategory">
        
            <v-text-field
                v-model="form.category_name"
                label="Category Name"
                type="text"
                required
            ></v-text-field>


            <v-btn color="pink" type="submit" v-if="editSlug" :disabled="disabled">Update</v-btn>
            <v-btn color="green" type="submit" v-else :disabled="disabled">Create</v-btn>
        </v-form>

        <v-card class="mx-auto mt-4" >
            <v-toolbar color="indigo" dark dense>

            <v-toolbar-title>Categories</v-toolbar-title>

            </v-toolbar>
                <v-list>
                    <v-list-item-group color="primary">
                        <div v-for="(category,index) in categories" :key="category.id">
                            <v-list-item >
                                <v-list-item-icon>
                                    <v-btn icon @click="edit(index)">
                                        <v-icon color="orange">mdi-pencil</v-icon>
                                    </v-btn>
                                </v-list-item-icon>
                                <v-list-item-content>
                                    <v-list-item-title>{{category.category_name}}</v-list-item-title>
                                </v-list-item-content>

                                <v-list-item-icon>
                                    <v-btn icon @click="destroy(category.category_slug, index)">
                                        <v-icon color="red">mdi-delete</v-icon>
                                    </v-btn>
                                </v-list-item-icon>                   
                            </v-list-item>
                            <v-divider></v-divider>
                        </div>
                    </v-list-item-group>
                </v-list>
        </v-card>
     </v-container>
</template>

<style scoped>

</style>

<script>

    export default {
        data(){
            return{
                form:{
                    category_name:null,
                },
                categories:{},
                editSlug:null,
                errors:null,
            }
        },
        created(){
            if(!User.isAdmin()){
                this.$router.push('/forum')
            }
            axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch()
        },
        computed:{
            disabled(){
                return !(this.form.category_name)
            }
        },
        methods:{
            storeCategory(){
                this.editSlug ? this.update() : this.create()
            },
            create(){
                axios.post('/api/category',this.form)
                .then(res => {
                    this.categories.unshift(res.data)
                    this.form.category_name = null
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            update(){
                axios.patch(`/api/category/${this.editSlug}`, this.form)
                .then(res => {
                    this.categories.unshift(res.data)
                    this.form.category_name = null
                })
                .catch(error => this.errors = error.response.data.errors)
            },
            destroy(slug, index){
                axios.delete(`/api/category/${slug}`)
                .then(res => this.categories.splice(index,1))
                .catch(error => this.errors = error.response.data.error)
            },
            edit(index){
                this.form.category_name = this.categories[index].category_name  
                this.editSlug = this.categories[index].category_slug
                this.categories.splice(index,1)
                
            }
        }
    }
</script>
