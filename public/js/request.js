$(document).ready(function(){
    function listenfordata(ids){
        let data = {};
    
        for (let i = 0; i < ids.length; i++) {
            const id = ids[i];
            data[id] = $('#'+id).val();        
        }
        return data;
    }
    
    let resaddcount = 0;
    let addedfile = [];

    let submit_clickable = true;
    $("#queue").click(function(){
        if (submit_clickable){      
            submit_clickable = false;  
            $('#queue').text('Submitting...');
            $('#errortab').parent().css("display", 'none');

            
            let data = listenfordata(['name']);

            axios({
                method: 'POST',
                url: "./api/ticket/addnew",
                headers: {
                    "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
                },
                data: {
                    createset:data,
                },
            }).then(response => {
                $('#queue').text('Queue');
                const data = response.data;
                submit_clickable = true;  

                console.log(response);

                if (data['response'] === 'passed'){
                    popAlert('Event created!');
                    window.location.href = './dashboard';
                }else{
                    if ((data['reason'] === 'valerror')){
                        let errs = JSON.parse(data['data']);
                        
                        console.log(errs);
                        let errtext = '';

                        for (const key in errs) {
                            errtext += '<li class="error">'+errs[key][0]+'</li>';
                        }
                        $('#errortab').parent().css("display", 'block');
                        $('#errortab').html(errtext);
                    }
                }
            })
            .catch(error => console.error(error))
        }


    });
    
    $(".c-vert.stat").click(function(){
        let state = $(this).attr('state');
        let code = $('meta[name="pagecode"]').attr('content');
        popAlert('Updating event state');
        axios({
            method: 'POST',
            url: window.location.origin + "/api/event/update",
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
            },
            data:{
                updpair:['code', code],
                updset:{
                    state:state
                }
            },
        }).then(response => {
            if (response.data.response == 'passed'){
                let appen = (state==2) ? 'ended' : ((state==1)? 'started': ((state==3)? 'DELETED': 'queued'));
                popAlert('Event successfully ' + appen);
            }else{
                console.log(response);
            }     
        })
        .catch(error => console.error(error))
    })

})