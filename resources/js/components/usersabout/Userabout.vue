<template lang="">
    <div class="col-lg-6 col-12 mt-5 mt-lg-0">
        <div class="row" style="padding: 10px; background-color: white; border-radius: 10px;margin: 10px;">
            
            <h5 style="padding-bottom: 20px">
                {{description.name}}
            </h5>

            <span style="padding-bottom: 10px; color: grey">
                {{description.description}}
            </span>

        </div>
    </div>
</template>
<script>

import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:"Event",    
    props:{
        description:Object,
    },
    methods:{
        toDetail(){
            window.location.href = window.location.origin + "/eventdetail/" + this.event.code;
        }
    },
    data(){
        return {
            
        }
    },
    mounted(){

    },
    created(){
        
    },
}
</script> 
<style lang="">
    
</style>