<template lang="">
    <div style="padding: 10px; border-radius: 5px; background-color:white; margin: 20px 0" >
        <h5 class="mb-0 event-head" style="font-size: 28px; padding: 20px"> Event Resources </h5>
        
        <Resource v-for="r in upresources" :resource="r"/>

    </div>
</template>
<script>
import Resource from './Resource.vue';
import Apimanager from '../../Utils/Apimanager.js'; 
export default {
    name:'ResourcesSuper',
    components:{
        Resource,
    },
    methods:{
        //define funsc here
    },
    data(){
        return {
            upresources:[],
            test:'tt'
        }
    },
    created(){
        let eventcode = $('meta[name="pagecode"]').attr('content');
        new Apimanager().getResources(eventcode, (resp)=>{
            let ret = [];
            try {
                console.log(resp);
                this.upresources = [...resp];              
            } catch (error) {
                console.log(error);
            }

        })
    },
    
}
</script>
<style lang="">
    
</style>