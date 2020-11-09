<template>
    <div>
        <v-list>
            <v-card class="mt-2">
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title class="title">
                            {{data.username}}
                        </v-list-item-title>
                        <v-list-item-subtitle> said {{data.created_at}}</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-spacer></v-spacer>
                    <like :content="data"></like>
                </v-list-item>

                <v-divider></v-divider>
                
                <edit-reply v-if="editing" :reply="data"></edit-reply>
            
                <v-card-text v-html="reply" v-else></v-card-text>
        
                <v-divider></v-divider>

                <div v-if="!editing">
                    <v-card-actions v-if="own">
                        <v-btn icon class="mr-2" @click="edit">
                            <v-icon color="orange">mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn icon @click="destroy">
                            <v-icon color="red">mdi-delete</v-icon>
                        </v-btn>
                    </v-card-actions>
                </div>

            </v-card>
        </v-list>
    </div>
</template>

<style scoped>

</style>

<script>
import EditReply from './EditReply'
import Like from '../like/Like'
export default {
    props:['data','index'],
    components:{EditReply,Like},
    data(){
      return{
          editing:false,
          beforeEditReplyBody:'',
      }  
    },
    created(){
        this.listen()
    },
    computed:{
        own(){
            return User.own(this.data.user_id)
        },
        reply(){
            return md.parse(this.data.reply_body)
        }
    },
    methods:{
        destroy(){
            EventBus.$emit('deleteReply',this.index)
        },
        edit(){
            this.editing = true
            this.beforeEditReplyBody = this.data.reply_body
        },
        listen(){
            EventBus.$on('cancelEditing',(reply)=>{
                this.editing = false
                if(reply !== this.data.reply_body){
                    this.data.reply_body = this.beforeEditReplyBody
                    this.beforeEditReplyBody = ''
                }
            })
        }
    }

}
</script>
