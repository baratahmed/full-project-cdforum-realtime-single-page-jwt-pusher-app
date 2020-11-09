<template>
    <div v-if="question">

        <edit-question :data="question" v-if="editing">            
        </edit-question>

        <show-question :data="question" v-else>
        </show-question> 

        <v-container>
            <replies :question="question"></replies>

            <create-reply :question_slug="question.question_slug" v-if="loggedIn"></create-reply>

            <div class="mt-4" v-else>
                <router-link to="/login" style="text-decoration:none;">
                  <v-btn color="orange">
                        Click here to log in
                  </v-btn>
                </router-link>
            </div>

        </v-container>

    </div>
</template>

<style scoped>

</style>

<script>
import ShowQuestion from './ShowQuestion'
import EditQuestion from './EditQuestion'
import Replies from '../reply/Replies'
import CreateReply from '../reply/CreateReply'

export default {
    data(){
        return{
            question:null,
            editing:false,
            beforeEditQuestionTitle:'',
            beforeEditQuestionBody:'',
        }
    },
    components:{ShowQuestion,EditQuestion,Replies,CreateReply},
    created(){
        this.listen()
        this.getQuestion()
    },
    computed:{
        loggedIn(){
            return User.loggedIn()
        }
    },
    methods:{
        listen(){
            EventBus.$on('startEditing', ()=>{
                this.editing = true;
                this.beforeEditQuestionTitle = this.question.question_title
                this.beforeEditQuestionBody = this.question.question_body
            })
            EventBus.$on('cancelEditing', (quesTitle,quesBody)=>{
                this.editing = false;
                if(quesTitle !== this.question.question_title || quesBody !== this.question.question_body){
                    this.question.question_title = this.beforeEditQuestionTitle
                    this.question.question_body = this.beforeEditQuestionBody
                    this.beforeEditQuestionTitle = ''
                    this.beforeEditQuestionBody = ''
                }
            })
        },
        getQuestion(){
            axios.get(`/api/question/${this.$route.params.slug}`)
            .then(res => this.question = res.data.data)
            .catch(err => console.log(err.response.data))
        }
    }
}
</script>
