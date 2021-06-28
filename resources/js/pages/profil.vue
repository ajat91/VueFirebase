<template>
    <div>
        <section v-if="id">
            <img v-if="detailuser.photo"  :src="'/images/'+detailuser.photo" alt="" width="100">
            <h1>Hello {{ detailuser.name }}.</h1>
            <p>Email :<strong>{{ detailuser.email }}</strong></p>
            <router-link :to="{name:'user'}">Kembali</router-link>
            <router-link :to="{name:'upload',params:{id:detailuser.id}}">Upload</router-link>
            <a href="" @click.prevent="handlingDelete">Hapus</a>
            <a href="" @click.prevent="handlingEdit">Edit</a>
            <!-- ada 2 cara pemanggilan router 
                  <router-link :to="{name:'user'}">Kembali</router-link>
            
            <router-link :to="{name:'edit'}">edit</router-link>-->
        </section>
    </div>
</template>
<script>
export default {
    props: ['id'],
    data(){
        return {
            detailuser:{}
        }
    },
    mounted(){
        this.getUser()
    },
    methods:{
        getUser(){
            axios.get('/api/users/'+this.id).then((response)=>{
                console.log(response)
                this.detailuser=response.data
        })
        },
        handlingDelete(){
            axios.delete('/api/users/'+this.id).then((response)=>{
                if (confirm('Apakah ingin dihapus')){
                    if (response.data.status){
                        this.$noty.success(response.data.message)
                        this.$router.push({
                        name:'user'
                        })
                    }
                }
                else {
                    return false
                }
            
            })
        },
        handlingEdit(){
             this.$router.push({
                name:"edit",
                params:{id:this.id}
            })
        }    
    }
}
</script>