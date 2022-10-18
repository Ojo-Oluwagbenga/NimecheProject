<template >

    <div class="container">
        <div class="row">
            <h1 style="padding-bottom: 20px; margin: 10px;">
                Connect with new people!
            </h1>
            <span style="padding-bottom: 10px; color: grey; margin: 10px;">
                Below are short description of people that are with you in the conference.
                <br>Connect with as much as possible.<strong>You may add your own descriptions from <a href="/myaccount" style="color:green">your account page</a></strong>
            </span>

            <div style="margin-left: 20%; border-left:2px solid red; padding: 20px 10px" class="empty">No about yet. Be the first to <a href="/account" style="color:green">create</a> </div>

            <Userabout v-for="descrip in usersdesc" :description="descrip"/>
        </div>
    </div>  
</template>
 
<script> 
import Userabout from './Userabout.vue';
import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:'EventsSuper',
    components:{
        Userabout,
    },
    props:{

    },
    methods:{

    },
    data(){
        return {
            usersdesc:[]
        }
    },
    mounted(){

    },
    created(){
        
        new Apimanager().getall_userabout((resp)=>{
            if (resp.data.response === 'passed'){
                this.usersdesc = [...resp.data.data];
            }
             
        });        
    },
}
</script> 
<style>
    .noevt{
        text-align:center;
    }
    
</style>