<template>
<div>
    <vue-simplemde v-model="reply.reply_body" ref="markdownEditor" />

     <v-card-actions>
        <v-btn icon class="mr-2" @click="update">
            <v-icon color="green">mdi-content-save</v-icon>
        </v-btn>
        <v-btn icon @click="cancel">
            <v-icon color="black">mdi-cancel</v-icon>
        </v-btn>
    </v-card-actions>

</div>
</template>

<style scoped>

</style>

<script>
    export default {
       props:['reply'],
       methods:{
           update(){
               axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,{reply_body:this.reply.reply_body})
               .then(res => this.cancel(this.reply.reply_body))
           },
           cancel(reply){
               EventBus.$emit('cancelEditing',reply)
           }
       }
    }
</script>
 