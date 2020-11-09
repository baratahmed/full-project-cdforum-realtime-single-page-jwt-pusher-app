<template>
    <v-card class="mx-auto mt-2">
        <v-card-title>
            <router-link class="qwerty" :to="data.question_path">
                {{data.question_title}}
            </router-link>
        </v-card-title>

        <v-card-subtitle>
            <b>{{data.username}}</b> said 
            {{data.created_at}}

        </v-card-subtitle>                  


        <v-divider></v-divider>

        <v-card-text>
            {{data.question_body}}
        </v-card-text>
    </v-card>
</template>

<style scoped>
.qwerty{
    text-decoration: none;
    color: darkblue;
}
</style>

<script>
    export default {
        props:['data'],
    } 
</script>
