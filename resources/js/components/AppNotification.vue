<template>
    <div class="text-center">
        <v-menu offset-y>
        <template v-slot:activator="{ on, attrs }">

            <v-btn icon class="mr-2" v-bind="attrs" v-on="on">
                <v-icon :color="color">mdi-bell-plus</v-icon> ({{unreadCount}})
            </v-btn>

        </template>
        
        <v-list>
            
            <v-list-item v-for="item in unread" :key="item.id">
                <router-link :to="item.question_path">
                    <v-list-item-title @click="readIt(item)">{{item.question_title}}</v-list-item-title>
                </router-link>
            </v-list-item>

            <v-divider></v-divider>

            <v-list-item v-for="item in read" :key="item.id">
            <v-list-item-title>{{item.question_title}}</v-list-item-title>
            </v-list-item>

        </v-list>
        </v-menu>
    </div>
</template>

<style scoped>

</style>

<script>

export default {
    data(){
        return{
            read:{},
            unread:{},
            unreadCount:0,
            sound:"http://soundbible.com/mp3/Bleat-SoundBible.com-893851569.mp3"
        }
    },
    created(){
       if (User.loggedIn()) {
           this.getNotifications()
       }
        Echo.private('App.User.' + User.id())
            .notification((notification) => {
               this.playSound()
               this.unread.unshift(notification)
               this.unreadCount++
        });
    },
    methods:{
        getNotifications(){
            axios.post('/api/notifications')
            .then(res => {
                    this.read = res.data.read
                    this.unread = res.data.unread
                    this.unreadCount = res.data.unread.length
            })
            .catch(err => Exception.handle(err))
        },
        readIt(notification){
            axios.post('/api/markAsRead', {id:notification.id})
            .then(res => {

            })
        },
        playSound(){
            let alert = new Audio(this.sound)
            alert.play()
        }
    },
    computed:{
        color(){
            return this.unreadCount > 0 ? 'red' : 'red lighten-3' 
        }
    }
}
</script>
