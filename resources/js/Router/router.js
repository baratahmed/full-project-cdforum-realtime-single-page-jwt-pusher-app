import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Parallex from '../components/Parallex';
import Login from '../components/login/Login';
import Signup from '../components/login/Signup';
import Forum from '../components/forum/Forum';
import Read from '../components/forum/Read';
import CreateQuestion from '../components/forum/CreateQuestion';
import CreateCategory from '../components/category/CreateCategory';
import Logout from '../components/login/Logout';

const routes = [
    { path: '/', component: Parallex },
    { path: '/login', component: Login },
    { path: '/logout', component: Logout },
    { path: '/signup', component: Signup },
    { path: '/forum', component: Forum, name:'forum' },
    { path: '/ask', component: CreateQuestion },
    { path: '/category', component: CreateCategory },
    { path: '/question/:slug', component: Read, name:'read' },
    
]

const router = new VueRouter({
    routes,
    mode: 'history',
})

export default router