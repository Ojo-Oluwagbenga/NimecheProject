<template lang="">
    <div class="col-lg-6 col-12" style="margin: 20px 0">
        <div class="profile-thumb" @click="toDetail()" style="cursor:pointer">
            <div class="profile-title">
                <h4 class="mb-0 event-head">{{event.name}}
                    <div class="c-vert event-full">
                        <svg style="height:15px; fill: green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                    </div>
                </h4>
            </div>

            <div class="profile-body">
                <p>
                    <span class="profile-small-title">Date</span> 
                    <span>{{event.date}}</span>
                </p>

                <p>
                    <span class="profile-small-title">Time</span> 
                    <span>{{event.time}}</span>
                </p>

                <p>
                    <span class="profile-small-title">Duration</span> 
                        <span><a>{{event.duration}}</a></span>
                </p>
 
                <p>
                    <span class="profile-small-title">Anchor</span> 
                    <span><a>{{event.anchor}}</a></span>
                </p>
            </div>
        </div>
        
    </div>
</template>
<script>

import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:"Event",    
    props:{
        event:Object,
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