<template>
<v-card class="mx-auto mt-2 ml-4" >
    <v-toolbar
      color="cyan"
      dark
    >

      <v-toolbar-title>Categories</v-toolbar-title>

    </v-toolbar>

        <v-list>
                <v-list-item-group color="primary">
                    <v-list-item v-for="category in categories" :key="category.id">
                        <v-list-item-content>
                            <v-list-item-title>{{category.category_name}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
        </v-list>
  </v-card>
</template>

<style scoped>

</style>

<script>
    export default{
        data(){
            return{
                categories:{}
            }
        },
        created(){
            axios.get('/api/category')
            .then(res => this.categories = res.data.data)
            .catch()
        }
    }
</script>
