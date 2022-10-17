<template >

    <div v-if="loading" class="container" style="margin-top: 20px">
        <h3>Loading requests....</h3>
    </div>

    <div v-if="!refetching && !loading"  class="reloadreqs" @click="refetch()" style="padding:10px; border-radius: 20px; border: 1px solid grey; cursor:pointer; max-width: 100px; text-align: center; margin: auto ">
        Refetch
    </div>
    <div v-if="refetching" class="reloadreqs" @click="refetch()" style="padding:10px; cursor:pointer; text-align: left; margin: flex-end ">
        Refreshing queue...
    </div>

    <div v-if="!loading" class="container" style="margin-top: 20px">
        <h2>Waiting requests</h2>
        <div class="row">

            <Foodrequest v-for="request in waiting" :request="request"/> 
            <div class="noevt" v-if="waiting.length == 0">No request is waiting</div>

        </div>
    </div>
    <div v-if="!loading" class="container" style="margin-top: 20px">
        <h2>Attended request</h2>
        <div class="row">
            
            <Foodrequest v-for="request in collected" :request="request"/> 
            <div class="noevt" v-if="collected.length == 0">No request has been attended to</div>
            
        </div>
    </div>
</template>
 
<script> 
import Foodrequest from './Foodrequest.vue';
import Apimanager from '../../Utils/Apimanager.js'; 

export default {
    name:'EventsSuper',
    components:{
        Foodrequest,
    },
    props:{
       
    },
    methods:{
        refetch(){
            this.refetching = true;
            let sharer = $('meta[name="sharercode"]').attr('content');
            popAlert('Refreshing queue...')
            new Apimanager().getall_page_req(sharer, (resp)=>{
                this.loading = false;
                this.refetching = false;
                let wait = [];
                let coll = [];

                if (resp.data.response === 'passed'){
                    let allreqs = resp.data.data;     
                    allreqs.forEach(ev => {
                        
                        if (ev.ticketstate === '1'){ 
                            wait.push(ev);
                        } 
                        if (ev.ticketstate === '2'){
                            coll.push(ev);
                        }                                    
                    });
                }
                this.collected = [...coll];
                this.waiting = [...wait];               
                
            });    
        }
    },
    data(){
        return {
            collected : [],
            waiting : [],
            loading: true,
            refetching: false,
        }
    },
    mounted(){

    },
    created(){
        let sharer = $('meta[name="sharercode"]').attr('content');
        new Apimanager().getall_page_req(sharer, (resp)=>{
            this.loading = false;

            if (resp.data.response === 'passed'){
                let allreqs = resp.data.data;     
                allreqs.forEach(ev => {
                    
                    if (ev.ticketstate === '1'){ 
                        this.waiting.push(ev);
                    } 
                    if (ev.ticketstate === '2'){
                        this.collected.push(ev);
                    }
                                
                });

            }
            console.log(this.collected);
            
            
        });        
    },
}
</script> 
<style>
    .noevt{
        text-align:center;
    }
    
</style>