
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// const home=require('../pages/home.vue').default
// const about=require('../pages/about.vue').default
//const NotFound=require('./pages/NotFound.vue').default
import NotFound from '../pages/NotFound.vue'
import home from '../pages/home.vue'
import about from '../pages/about.vue'
import user from '../pages/user.vue'
import welcome from '../pages/welcome.vue'
import profil from '../pages/profil.vue'
import register from '../pages/register.vue'
import edit from '../pages/edit.vue'
import uploadGambar from '../pages/uploadGambar.vue'


const routes=[
    {
        
        path:'/',
        component:welcome
    },
    {
        name:'home',
        path:'/home',
        component:home
    },
    {
        name:'about',
        path:'/about',
        component:about
    },
    {
        name:'user',
        path:'/user',
        component:user
    },
    {
        name:'register',    
        path:'/user/create',
        component:register
    },
    {
        name:'profil',
        path:'/user/:id',
        component:profil,
        props:true
    },
    {
        name:'upload',
        path:'/user/:id/photo',
        component:uploadGambar,
        props:true
    },
    {
        name:'edit',
        path:'/user/:id/edit',
        component:edit,
        props:true
    },
    {
        path:'*',
        component:NotFound
    }
]
const router=new VueRouter ({
    linkActiveClass:'active',
    mode:'history',
    routes
})

export default router