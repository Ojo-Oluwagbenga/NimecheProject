<template lang="">

    <div id="OUVHWFNHQTRKWnFMOXQ5R1dPRUFrZz09" class="commentPack">
        <div class="senderPicsLine">
            <div class="line"></div>
            <div class="profilePic">O</div>
        </div>

        <div class="commentSuperBox">
            <div class="commentBox" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px;">
                <div class="cbHead">
                    <div class="namePack">
                        <div class="name">Benson Sun</div>
                    </div>
                    <div class="time">Tuesday 10:48:34 PM</div>
                </div>
                <div class="cbBody ql-editor">
                    Yeah Oluwagenga. Can we meet after the event so I can get your note?
                </div>
                <div class="cbIcons">
                    <div class="reply">Reply <i class="fas fa-solid fa-reply-all" aria-hidden="true"></i></div>
                    
                </div>
            </div>
            <div class="otherReplies" openstate="1">
                
            </div>
        </div>
    </div>   

</template>
<script>

import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:"Comment",    
    props:{
        node:Object,
    },
    methods:{
        downloadlink(){
            let eventcode = $('meta[name="pagecode"]').attr('content');
            let link = window.location.origin+'/eventfiles/event_'+eventcode+'/'+this.resource;
            new Apimanager().download(link);
        },
    },
    data(){
        return {
            resname:''
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