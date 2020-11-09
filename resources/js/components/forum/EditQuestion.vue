<template>
<v-container fluid>
    <v-card>
        <v-form @submit.prevent="update">
            <v-text-field
            v-model="form.question_title"
            label="Title"
            type="text"
            required
            ></v-text-field>

            <vue-simplemde v-model="form.question_body" ref="markdownEditor" />

            <v-card-actions>
                <v-btn icon type="submit">
                    <v-icon color="green">mdi-content-save</v-icon>
                </v-btn>
                <v-btn icon >
                    <v-icon color="red" @click="cancel">mdi-cancel</v-icon>
                </v-btn>
            </v-card-actions>

        </v-form>
    </v-card>
</v-container>
</template>

<style scoped>

</style>

<script>
export default {
    props:['data'],
    data(){
        return{
            form:{
                question_title:null,
                question_body:null,
            }
        }
    },
    mounted(){
        this.form = this.data
    },
    methods:{
        cancel(quesTitle,quesBody){
            EventBus.$emit('cancelEditing',quesTitle,quesBody)            
        },
        update(){
            //axios.patch(`/api/question/${this.data.question_slug}`, this.data)
            axios.patch(`/api/question/${this.form.question_slug}`, this.form)
            .then( res => this.cancel(this.form.question_title,this.form.question_body) )
            .catch(err => console.log(err.response.data))
        }
    }
}
</script>
