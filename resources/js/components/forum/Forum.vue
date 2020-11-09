<template>
    <v-container>
        <v-row no-gutters>
            <v-col cols="8">
                <question v-for="question in questions" :key="question.path" :data="question">
                </question>

                <div class="text-center">
                    <v-pagination
                    v-model="meta.current_page"
                    :length="meta.last_page"
                    @input="changePage"
                    ></v-pagination>
                </div>
            </v-col>

            <v-col cols="4">
                <app-sidebar></app-sidebar>
            </v-col>
        </v-row>
  </v-container>

</template>

<style scoped>

</style>

<script>
    import Question from './Question'
    import AppSidebar from './AppSidebar'

    export default {
        components:{Question,AppSidebar},
        data(){
            return{
                questions:null,
                meta:{}
            }
        },
        created(){
            this.fetchQuestions()
        },
        methods:{
            fetchQuestions(pageNo){
                let url = pageNo ? `/api/question?page=${pageNo}` : '/api/question'
                axios.get(url)
                .then( res => {
                    this.questions = res.data.data
                    this.meta = res.data.meta
                })
                .catch(err => console.log(err.response.data))
            },
            changePage(pageNo){
                this.fetchQuestions(pageNo)
            }
        },
       
    } 
</script>
