<template>
    <div class="mt-4">
        <vue-simplemde v-model="reply_body" ref="markdownEditor" />
        <v-btn dark color="green" @click="submitReply">
            Reply
        </v-btn>
    </div>
    
</template>

<style scoped>

</style>

<script>
    export default {
        props:['question_slug'],
        data(){
            return{
                reply_body:null,
            }
        },
        methods:{
            submitReply(){
                axios.post(`/api/question/${this.question_slug}/reply`, {reply_body:this.reply_body})
                .then(res => {
                    this.reply_body = ''
                    EventBus.$emit('newReply',res.data.reply)
                    window.scrollTo(0,0)
                })
                .catch()
            }
        },

    }
</script>
 