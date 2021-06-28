<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="handlesubmit" action="/users" method="POST">
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
                        <tr><label for="">Password</label></tr>
                        <tr>
                            <input type="password" v-model="form.password">
                            <td>
                                <div class="error" v-if="errors.password">
                                    {{ errors.password[0] }}
                                </div>
                            </td>
                        </tr>
                        <br>
                        <tr><button type="submit">Register</button></tr>
                    </td>
                </div>
            </table>
            <!-- <div class="input-group">
                <label for="">Name</label>
                <input type="text" v-model="form.name">
                <div class="error" v-if="errors.name">
                    {{ errors.name[0] }}
                </div>
            </div>
            <div class="input-group">
                <label for="">Email</label>
                <input type="text" v-model="form.email">
                <div class="error" v-if="errors.email" >
                    {{ errors.email[0] }}
                </div>
            </div>
            <div class="input-group">
                <label for="">Password</label>
                <input type="password" v-model="form.password">
                <div class="error" v-if="errors.password">
                    {{ errors.password[0] }}
                </div>
            </div>
            <button type="submit">Register</button> -->
        </form>
    </div>   
</template>
<script>
export default {
    data(){
        return{
            form :{
                name:"",
                email:"",
                password:""
            },
             errors : {}
        }
   
    },
  
    methods:{
        handlesubmit(){
            console.log(this.form)
            axios.post('/api/users',this.form).then ((response)=>{
               if(response.data.status){
                console.log(response)
                this.$noty.success(response.data.message)
                //alert(response.data.message)
                this.$router.push({
                    name:'user'
                })
               }
            }).catch ((error)=>{
          
                if (error.response.status == 403){
                     this.errors=error.response.data.message
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