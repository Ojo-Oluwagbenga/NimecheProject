<template >
    <div class="container">
        <div class="row">
            <div v-if="ticketdata.loading" class="col-lg-6 col-12" style="border-left: 3px solid red;padding-top:100px;border-right: 3px solid red;">
                <div class="profile-thumb" >
                    <div class="profile-title">
                        <h4 class="mb-0 event-head">
                            Checking for available Tickets...
                        </h4>
                    </div>
                </div>
            </div>

            <div v-if="ticketdata.set" class="col-lg-6 col-12" style="border-left: 3px solid red;padding-top:100px;border-right: 3px solid red;">
                <h5 v-if="ticketdata.userticketstate == 0"  id="sharerid" sh=1 style="padding:5px">Collecting from Sharer {{ticketdata.userticketsharer}}. <span style="color:blue;cursor:pointer" @click="togglesharer()" sh="1">Tap to change</span></h5>
                <h5 v-if="ticketdata.userticketstate == 1"  id="sharerid" sh=1 style="padding:5px">Collect your package from Sharer {{ticketdata.userticketsharer}}.</h5>
                <h5 v-if="ticketdata.userticketstate == 2"  id="sharerid" sh=1 style="padding:5px">Package Collected from sharer {{ticketdata.userticketsharer}} </h5>

                <div class="profile-thumb">
                    <div class="profile-title">
                        <h4 class="mb-0 event-head">{{ticketdata.ticketname}}
                            <div v-if="ticketdata.userticketstate == 0"  @click="acceptfood()" style="cursor:pointer" class="c-vert event-full">
                                Collect
                            </div>
                        </h4>
                    </div>

                    <div class="profile-body">
                        <p>
                            <span class="profile-small-title">Code</span> 
                            <span>{{ticketdata.usercode}}</span>
                        </p>

                        <p>
                            <span class="profile-small-title">Name</span> 
                            <span>{{ticketdata.username}}</span>
                        </p>
                    </div>
                </div>
            </div>

            

            <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                <div class="about-thumb">
                    <div class="row">
                        <div class="col-lg-6 col-6 featured-border-bottom py-2">
                            <strong class="featured-numbers">20+</strong>

                            <p class="featured-text">Institutions</p>
                        </div>

                        <div class="col-lg-6 col-6 featured-border-start featured-border-bottom ps-5 py-2">
                            <strong class="featured-numbers">240+</strong>

                            <p class="featured-text">Student Engineers</p>
                        </div>

                        <div class="col-lg-6 col-6 pt-4">
                            <strong class="featured-numbers">40+</strong>

                            <p class="featured-text">Engineers</p>
                        </div>

                        <div class="col-lg-6 col-6 featured-border-start ps-5 pt-4">
                            <strong class="featured-numbers">10+</strong>

                            <p class="featured-text">Organizations</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container" style="margin-top: 20px">
        <h2>Ongoing events</h2>
        <div class="row">

            <Event v-for="event in current_events" :event="event"/> 
            <div class="noevt" v-if="current_events.length == 0">No event is currently ongoing. Catch some breeze!</div>

        </div>
    </div>
    <div class="container" style="margin-top: 20px">
        <h2>Upcoming events</h2>
        <div class="row">

            <Event v-for="event in future_events" :event="event"/> 
            <div class="noevt" v-if="future_events.length == 0">No upcoming event has been Scheduled</div>
            

        </div>
    </div>
    <div class="container" style="margin-top: 20px">
        <h2>Past events</h2>
        <div class="row">

            <Event v-for="event in past_events" :event="event"/> 
            <div class="noevt"  v-if="past_events.length == 0">No event has been concluded yet</div>
        </div>
    </div>
</template>
 
<script> 
import Event from './Event.vue';
import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:'EventsSuper',
    components:{
        Event,
    },
    props:{

    },
    methods:{
        togglesharer(){
            let k = this.ticketdata.userticketsharer
            k = (k)%4;
            this.ticketdata.userticketsharer = k+1;
        },
        acceptfood(){
            popAlert('Collecting...');
            let sharer = this.ticketdata.userticketsharer;
            let tcode = this.ticketdata.ticketcode;

            new Apimanager().queue_user_for_food(sessionStorage.getItem('user'), sharer, tcode, (resp) =>{
                $("#sharerid").html("Get your package from sharer " + this.ticketdata.userticketsharer);
                this.ticketdata.userticketstate = 1;
                popAlert('Queued for collecting');
            });
            
        },
        activateTicket(){
            popAlert('Activating');
            let activtik = $('meta[name="ticket"]').attr('content');
            new Apimanager().activate_ticket(activtik, (resp)=>{
                popAlert('Activated');
                this.adminticketstate = 1;
            });
        },
        deleteTicket(){
            popAlert('Activating');
            let activtik = $('meta[name="ticket"]').attr('content');
            new Apimanager().delete_ticket(activtik, (resp)=>{
                popAlert('Activated');
                this.adminticketstate = 1;
                this.ticketon= false;
            });
        },
    },
    data(){
        return {
            future_events : [],
            current_events : [],
            past_events : [],

            ticketdata:{
                loading:true,
                set:false
            },
        }
    },
    mounted(){

    },
    created(){

        let mymanager = new Apimanager();

        mymanager.getallevents((resp)=>{
            let allevents = resp.data;
            
            allevents.forEach(ev => {
                if (ev.state === '0'){
                    this.future_events.push(ev);
                }
                if (ev.state === '1'){
                    this.current_events.push(ev);
                }
                if (ev.state === '2'){
                    this.past_events.push(ev);
                }
                
            });
            this.events = resp.data;
        });

        mymanager.load_userticketdata((resp)=>{
            this.ticketdata.loading = false;
            let data = resp.data;
            if (data.response === 'passed'){
                this.ticketdata = {...data.data, set:true};
                if (this.ticketdata.userticketsharer == null){
                    this.ticketdata.userticketsharer = 1;
                }
                
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