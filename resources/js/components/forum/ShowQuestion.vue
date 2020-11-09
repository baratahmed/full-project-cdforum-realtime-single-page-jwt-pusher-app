<template>
    <v-card class="mx-auto">
        <v-container>        
            <v-card-title>
                {{data.question_title}}                
                <v-spacer></v-spacer>               
                <v-btn color="teal" dark>{{replyCount}} Replies</v-btn>
            </v-card-title>

            <v-card-subtitle>
                <b>{{data.username}}</b> said {{data.created_at}}
            </v-card-subtitle> 
            
            <v-divider></v-divider>

            <v-card-text v-html="questionBody"></v-card-text>

            <v-card-actions v-if="own">
                <v-btn icon>
                    <v-icon color="orange" @click="edit">mdi-pencil</v-icon>
                </v-btn>
                <v-btn icon @click="destroy">
                    <v-icon color="red">mdi-delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-container>
    </v-card>
</template>

<style scoped>

</style>

<script>
    export default {
        props:['data'],
        data(){
            return{
                own: User.own(this.data.user_id),
                replyCount: this.data.replies_count
            }
        },
        created(){
            EventBus.$on('newReply',()=>{
               this.replyCount++
            });
            Echo.private('App.User.' + User.id())
            .notification((notification) => {
                this.replyCount++
            });

            EventBus.$on('deleteReply',()=>{
               this.replyCount--
            });

            Echo.channel('deleteReplyChannel')
            .listen('DeleteReplyEvent', (e) => {
               this.replyCount--               
            });
            

        },
        methods:{
            destroy(){
                axios.delete(`/api/question/${this.data.question_slug}`)
                .then(res => this.$router.push('/forum'))
                .catch(err => console.log(err.response.data))
            },
            edit(){
                EventBus.$emit('startEditing')                
            }
        },
        computed:{
            questionBody(){
                return md.parse(this.data.question_body)
            }
        }
    }
</script>
