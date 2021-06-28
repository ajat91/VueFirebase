<template>
    <div>
        <h1>Update Datauser</h1>
        <form @submit.prevent="handleupdate" action="/users" method="POST">
            <table>
                <div class="input-group">
                    <td>
                        <tr><label for="">Name</label></tr>
                        <tr>
                            <input type="text" v-model="form.name">
                            <td>  
                                <div class="error" v-if="errors.name">
                                    {{ errors.name[0] }}
                                </div>
                            </td>
                        </tr>
                        <tr><label for="">Email</label></tr>
                        <tr>
                            <input type="text" v-model="form.email">
                            <td>
                                <div class="error" v-if="errors.email" >
                                    {{ errors.email[0] }}
                                </div>
                            </td>
                        </tr>
                        <br>
                        <tr><button type="submit">Update</button></tr>
                    </td>
                </div>
            </table>
        </form>
    </div>   
</template>
<script>
export default {
    props:['id'],
    data(){
        return{
            form :{
                name:"",
                email:""
            },
             errors : {}
        }
   
    },
    mounted(){
        this.getUser()
    },
    
    methods:{
        handleupdate(){
            axios.put('/api/users/'+this.id,this.form).then ((response)=>{
               if(response.data.status){
                this.$noty.success(response.data.message)
                this.$router.push({
                    name:'user'
                })
               }
            }).catch ((error)=>{
                if (error.response.status == 403){
                     this.errors=error.response.data.message
                }
            })
        },
        getUser(){
            axios.get('/api/users/'+this.id).then((response)=>{
                console.log(response)
                this.form={
                 name:response.data.name,
                 email:response.data.email   
                }
        })
    }
}
}
</script>
<style>
    .input-group{
        margin-bottom: 5px;
    }
</style>