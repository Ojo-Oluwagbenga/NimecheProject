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
                querypair:{'id':8},
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