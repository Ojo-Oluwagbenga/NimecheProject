<template lang="">
    
    
    
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                <form action="#" method="get" class="custom-form contact-form" role="form">
                    <div class="row" style="padding-top: 20px">
                        <h1 style="padding-bottom: 20px">
                            What have you learnt?
                        </h1>
                        <span style="padding-bottom: 10px; color: grey">
                            Help others discover what's going on by sharing what you've learnt so far to every other students
                            <br>Your observations, short note and key points.
                        </span>
                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="comment_message" name="message"></textarea>
                                
                                <label for="floatingTextarea">Your thoughts</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12 ms-auto">
                            <div style="text-align:center" @click="addComment()" class="form-control">Send</div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                <form class="custom-form contact-form" role="form">
                    <div class="row" style="background-color: white; padding: 20px; border-radius: 10px;">
                        <h1 style="padding-bottom: 20px">
                            Here's what others think
                        </h1>
                        <div class="commentSuperPack" style="max-height: unset;">


                            <div id="OUVHWFNHQTRKWnFMOXQ5R1dPRUFrZz09" class="commentPack">
                                <div class="senderPicsLine">
                                    <div class="line"></div>
                                    <div class="profilePic">O</div>
                                </div>
                                <div class="commentSuperBox">
                                    <div class="commentBox" style="box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px;">
                                        <div class="cbHead">
                                            <div class="namePack">
                                                <div class="name">Ojo Oluwagben...</div>
                                            </div>
                                            <div class="time">Tuesday 10:48:34 PM</div>
                                        </div>
                                        <div class="cbBody ql-editor">
                                            I've learnt a lot from this. Thumbs up.
                                        </div>
                                        <div class="cbIcons">
                                            <div class="reply">Reply <i class="fas fa-solid fa-reply-all" aria-hidden="true"></i></div>
                                            
                                        </div>
                                    </div>

                                    <div class="otherReplies" openstate="1">
                                        <Comment :node="{}"/>
                                    </div>
                                </div>
                            </div>                        
                            
                            <div class="upost-show-more" style="display: none;"></div>
                        </div>
                    </div>
                </form>
            </div>
        
        </div>
    </div>  
</template>
<script>
import Comment from './Comment.vue';
export default {
    name:'CommentsSuper',
    components:{
        Comment
    },
    props:{
        
    },
    methods:{
        addComment(){
            let comment = $("#comment_message").val();
            popAlert('Feature coming soon!!!')
        },
        downloadlink(){
            let eventcode = $('meta[name="pagecode"]').attr('content');
            let link = window.location.origin+'/eventfiles/event_'+eventcode+'/'+this.resource;
            new Apimanager().download(link);
        },
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

<style>
    .commentSuperPack{
        position:relative;
        overflow-y: hidden;
        max-height: 200px;
        transition: max-height 0.3s ease-out;
    }
    .commentPack{
        display: flex;
        flex-direction: row;
        width: 100%;
    }
    .commentPack .senderPicsLine{
        position: relative;
        min-width: 40px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        margin-left: 20px;
    }
    .commentPack .senderPicsLine .line{
        height: 100%;
        width: 2px;
        background-color: grey;
    }
    .commentPack .senderPicsLine .profilePic{
        position: absolute;
        top: 10px;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        display: flex;
        flex-direction:column;
        justify-content: center;
        text-align: center;
        font-weight:bold;
        background-image: linear-gradient(to right, grey, white);
        border: 3px dashed grey;
        cursor: pointer;
    }
    .commentSuperBox{
        display: flex;
        flex-direction: column;
        margin-left: 20px;
        min-width: 200px;
        width: 100%;
    }
    .commentSuperBox .otherReplies{
        transition: height 0.2s linear, opacity 0.2s linear;
    }
    .commentSuperBox .commentBox{
        margin: 8px;
        border-radius: 5px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: none !important;
        padding: 10px;
        
    }
    .commentBox .cbHead{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* height: 40px; */
        padding: 2px 3px 15px 6px;
        /* background-color: grey; */
        font-size: 13px;
        color: grey;
        border-bottom: 0.1px dashed grey;
    }
    .cbHead .namePack{
        display: flex;
        flex-direction: column;
        font-size: 14px;
        padding: 2px 0px;
        font-weight: bold;
    }
    .namePack .name{
        font-weight: bold;
        color: black;
        cursor: pointer;
    }
    .namePack .nameRank{
        font-size: 7px;
        padding: 2px 0px;
        color: red;
    }
    .cbHead .time{
        display: flex;
        flex-direction: column;
        font-size: 14px;
        padding: 2px 0px;
    }
    .commentBox .cbBody{
        padding: 10px;
        cursor: pointer;
        height:unset !important;
    }
    .commentBox .ql-editor > *{
        cursor: pointer !important;
    }
    .commentBox .cbIcons{
        display: flex;
        flex-direction: row-reverse;
        font-size: 14px;
        padding: 5px;
        font-weight:bold;
    }
    .commentBox .cbIcons > :nth-child(n){
        padding: 0px 7px;
        cursor:pointer;
        
    }
    /* .commentBox .cbIcons .reply{
    } */
    .commentBox .cbIcons .rate q{
        padding:0px 2px;
    }
    .commentBox .cbIcons .rate span{
        padding-left: 3px;
        opacity:0.6;
        color:rgb(255 68 68);
        /* font-size: 12px; */
    }

</style>