<template>
    <div>
        <section>
            <h1>Daftar User</h1>
            <router-link to="/user/create">Register</router-link>
            <ul>
                <li v-for="user in users" v-bind:key="user.id">
                    <a href="" @click.prevent="lihatuser(user.id)">{{ user.name }}</a>
                </li>
                <!-- <li v-for="user in users" v-bind:key="user.id">
                   <router-link :to="profile_url(user.name)">{{  user.name }}</router-link>
                </li> -->
            </ul>
        </section>
    </div>
</template>
<script>
export default {
    data(){
        return {
            users:[]
        }
    },
    //ada dua cara meng get api data menggunakan axios atau fetch api
    mounted(){
        // axios.get('/api/users').then((response)=>{
        //     console.log(response);
        //     this.users=response.data
        // })

        // fetch('/api/users')
        // .then(response => response.json())
        // .then(data => {
        //     console.log(data)
        //     this.users=data
        // })
        this.getUsers()
    },
    methods:{
        getUsers(){
            axios.get('/api/users').then((response)=>{
            console.log(response);
            this.users=response.data
        })

        },
        profile_url(name){
            return '/user/'+name.toLowerCase()
        },
        lihatuser(id){
            this.$router.push({
                name:"profil",
                params:{id}
            })
        }
    }
}
</script>