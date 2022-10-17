export default class Apimanager{
    getResources(eventcode, func){
        // Fetches from apod
        let url = window.location.origin + '/api/event/fetch';
        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                querypair:{'code':eventcode},
                fetchset:['resources']
            },
        }).then(response => {
            try {
                let data = JSON.parse(response.data[0]['resources']);
                func(data); 
            } catch (error) {
                console.log(error);
            }
            
            
                    
        })
        .catch(error => console.error(error))

    }

    getallevents(func){

        let url = window.location.origin + '/api/event/fetch';
        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                querypair:{},
                fetchset:'*'
            },
        }).then(response => {
            func(response); 
                    
        })
        .catch(error => console.error(error))
    }
    addeventcomment(eventcode, comment, parentcode, func){
        // Fetches from apod
        let url = window.location.origin + '/api/event/fetch';
        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                parentcode:parentcode, 
                eventcode:eventcode, 
                comment:comment, 
            },
        }).then(response => {
            try {
                let data = JSON.parse(response.data[0]['resources']);
                func(data); 
            } catch (error) {
                console.log(error);
            }
            
            
                    
        })
        .catch(error => console.error(error))

    }

    load_userticketdata(func){

        let url = window.location.origin + '/api/ticket/load_userticketdata';
        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                user:sessionStorage.getItem('user'),
                //gets sharer, collectstate, nameofuser, ticket name: The ticket name is the active one currently
            },
        }).then(response => {
            try {
                func(response); 
            } catch (error) {
                console.log(error);
            }
            
            
                    
        })
        .catch(error => console.error(error))

    }
    queue_user_for_food(usercode, sharer, ticketcode, func){

        console.log("-----" + sharer);

        let url = window.location.origin + '/api/ticket/queue_user';

        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                usercode:usercode,
                sharer:sharer,
                ticketcode:ticketcode
            },
        }).then(response => {
            console.log(response);
            if (response.data.response === 'passed'){
                func(response); 
            }else{
                popAlert(response.data.reason)
            }
           
                    
        })
        .catch(error => console.error(error))
    }
    activate_ticket(ticketcode, func){

        let url = window.location.origin + '/api/ticket/update';

        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                updset:{
                    'status':1
                },
                updpair:['code', ticketcode],
            },
        }).then(response => {
            if (response.data.response === 'passed'){
                func(response.data); 
            }else{
                popAlert(response.data.reason)
            }
           
                    
        })
        .catch(error => console.error(error))
    }
    delete_ticket(ticketcode, func){

        let url = window.location.origin + '/api/ticket/update';

        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                updset:{
                    'status':2
                },
                updpair:['code', ticketcode],
            },
        }).then(response => {
            if (response.data.response === 'passed'){
                func(response.data); 
            }else{
                popAlert(response.data.reason)
            }
           
                    
        })
        .catch(error => console.error(error))
    }

    getall_page_req(sharer, func){
        
        let url = window.location.origin + '/api/ticket/get_all_req_users';
 
        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache', 
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                sharer:sharer,
            },
        }).then(response => {
            func(response);                           
        })
        .catch(error => console.error(error))
    }

    grant_user_req(sharer, user, func){
        
        let url = window.location.origin + '/api/ticket/grant_req_user';
 
        axios({
            method: 'POST',
            url: url,
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                sharer:sharer,
                user:user
            },
        }).then(response => {
            console.log(response);
            if (response.data.response === 'passed'){
                func(response); 
            }else{
                popAlert(response.data.reason)
            }                             
        })
        .catch(error => console.error(error))
    }

    getall_userabout(func){
        
        let url = window.location.origin + '/api/user/getall_userabout';
 
        axios({
            method: 'POST',
            url: url, 
            headers: {
                'Cache-Control': 'no-cache',
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data: {
                
            },
        }).then(response => {
            
            if (response.data.response === 'passed'){
                func(response); 
            }else{
                console.log(response.data.reason)
            }                             
        })
        .catch(error => console.error(error))
    }

    

    download(source){
        const fileName = source.split('/').pop();
        var el = document.createElement("a");
        el.setAttribute("href", source);
        // el.setAttribute("href", 'https://facebook.com');
        el.setAttribute("download", fileName);
        document.body.appendChild(el);
        el.click();
        el.remove();
    }
} 