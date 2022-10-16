<template lang="">
    <div  class="col-lg-6 col-12" style="margin: 20px 0">
        <div class="profile-thumb">
            <div class="profile-title">
                <h4  class="mb-0 event-head">{{request.code}}
                    <div  v-if="request.ticketstate === '1'"  @click="grant_user_req()"  class="c-vert event-full"  style="cursor:pointer">
                        Grant
                    </div>
                </h4>
            </div>

            <div class="profile-body">
                <p>
                    <span class="profile-small-title">Name</span> 
                    <span>{{request.name}}</span>
                </p>
                <!-- 
                <p>
                    <span class="profile-small-title">code</span> 
                    <span>request.code</span>
                </p> -->
            </div>
        </div>
        
    </div>
</template>
<script>

import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:"Event",    
    props:{
        request:Object,
    },
    methods:{
        grant_user_req(){
            popAlert ('Accepting User');
            new Apimanager().grant_user_req(this.request.ticketsharer, this.request.code, (resp) =>{
                console.log(resp);
                if (resp.data.response === 'passed'){
                    popAlert ('User Accepted');
                    this.request.ticketstate = 2;
                }
                
            });
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