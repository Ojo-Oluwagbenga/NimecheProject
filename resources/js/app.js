
import { createApp } from "vue";
import EventsSuper from "./components/events/EventsSuper.vue";
import CommentsSuper from "./components/comments/CommentsSuper.vue";
import ResourcesSuper from "./components/resources/ResourcesSuper.vue";
import FoodrequestsSuper from "./components/foodrequests/FoodrequestsSuper.vue";
import UsersaboutSuper from "./components/usersabout/UsersaboutSuper.vue";
import Apimanager from './Utils/Apimanager.js';
import Statemanager from './Utils/Statemanager.js';

//Note all your vue control element must carry a class vueport 
//And attr 'for' based on what we are loading. Must definitely bear an unique id too


//Clear storage on reload
// new Statemanager().Renew();


let Mycomponents = {  
    EventsSuper:EventsSuper,
    CommentsSuper:CommentsSuper,
    ResourcesSuper:ResourcesSuper,
    FoodrequestsSuper:FoodrequestsSuper,
    UsersaboutSuper:UsersaboutSuper,
}

let vmodule = $('.vueport');
vmodule.each(function(){

    let vmod = $(this);
    let compo = vmod.attr('for');

    createApp(Mycomponents[compo]).mount("#"+vmod.attr('id'));
})

