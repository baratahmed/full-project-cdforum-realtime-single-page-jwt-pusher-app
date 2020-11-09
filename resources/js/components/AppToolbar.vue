<template>
    <v-toolbar color="indigo" dark>

      <v-toolbar-title>
          <router-link to="/" style="text-decoration: none;">
              <h3 style="color:rgb(0, 188, 212);">CD FORUM</h3>
          </router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <app-notification v-if="loggedIn"></app-notification>
      <router-link v-if="item.show" v-for="item in items" :to="item.to" :key="item.title" class="qwerty" >
        <v-btn text class="qwerty2">
            {{item.title}}
        </v-btn>
      </router-link>
    </v-toolbar>

</template>

<style scoped>
.qwerty{
    text-decoration: none;
    background: rgb(0, 188, 212);
    margin-right: 5px;
}
.qwerty2{
    color:rgb(0, 0, 0);
}
</style>

<script>
import AppNotification from './AppNotification'
    export default {
        components:{AppNotification},
        data(){
            return{
                loggedIn:User.loggedIn(),
                items:[
                    {title:'Forum', to:'/forum', show:true},
                    {title:'Ask Question', to:'/ask', show: User.loggedIn()},
                    {title:'Create a Category', to:'/category', show: User.isAdmin()},
                    {title:'Login', to:'/login', show: !User.loggedIn()},
                    {title:'Logout', to:'/logout', show: User.loggedIn()},
                ]
            }
        },
        created(){
            EventBus.$on('logout', ()=>{
                User.logout();
                window.location = '/forum'
            })
        }
    }
</script>
