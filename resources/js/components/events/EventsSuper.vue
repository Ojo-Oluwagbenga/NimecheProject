<template >
    <div class="container">
        <div class="row">

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
            <!-- 
            <div class="col-lg-6 col-12" style="margin: 20px 0">
                <div class="profile-thumb">
                    <div class="profile-title">
                        <h4 class="mb-0">Technical Exhibition</h4>
                    </div>

                    <div class="profile-body">
                        <p>
                            <span class="profile-small-title">Date</span> 
                            <span>Sat, Aug 10 2022</span>
                        </p>

                        <p>
                            <span class="profile-small-title">Time</span> 
                            <span>10:30am</span>
                        </p>

                        <p>
                            <span class="profile-small-title">Duration</span> 
                                <span><a href="#">3 hours</a></span>
                        </p>

                        <p>
                            <span class="profile-small-title">Anchor</span> 
                            <span><a href="#">Student Body</a></span>
                        </p>
                    </div>
                </div>
                
            </div>
            
            <div class="col-lg-6 col-12" style="margin: 20px 0">
                <div class="profile-thumb">
                    <div class="profile-title">
                        <h4 class="mb-0">Games</h4>
                    </div>

                    <div class="profile-body">
                        <p>
                            <span class="profile-small-title">Date</span> 
                            <span>Sat, Aug 10 2022</span>
                        </p>

                        <p>
                            <span class="profile-small-title">Time</span> 
                            <span>10:30am</span>
                        </p>

                        <p>
                            <span class="profile-small-title">Duration</span> 
                                <span><a href="#">3 hours</a></span>
                        </p>

                        <p>
                            <span class="profile-small-title">Anchor</span> 
                            <span><a href="#">Student Body</a></span>
                        </p>
                    </div>
                </div>
                
            </div> -->

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

    },
    data(){
        return {
            future_events : [],
            current_events : [],
            past_events : [],
        }
    },
    mounted(){

    },
    created(){
        new Apimanager().getallevents((resp)=>{
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
    },
}
</script> 
<style>
    .noevt{
        text-align:center;
    }
    
</style>