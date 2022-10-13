$(document).ready(function(){

    let submit_clickable = true;
    $('#submit').click(function(){
        if (submit_clickable){      
            submit_clickable = false;  
            $('#submit').text('Submitting...');
            $('.error').remove();


            let coldata = listenfordata(['emailorcode', 'password']);

            coldata['redir'] = 'yes';

            axios({
                method: 'POST',
                url: './api/user/validate',
                headers: {
                    "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
                },
                data: coldata
            }).then(response => {
                const data = response.data;
                $('#submit').text('Submit');
                submit_clickable = true;  

                console.log(response);
                if (data['response'] === 'passed'){
                    sessionStorage.setItem('user', data['data']['user']);
                    window.location.href = './dashboard';
                }else{
                    if ((data['reason'] === 'valerror')){
                        let errs = JSON.parse(data['data']);
                        for (const key in errs) {
                            let errtext = '<div class="error">'+errs[key]+'</div>'
                            try {
                                $('#'+key).prepend(errtext)
                            } catch (error) {
                                
                            }
                            
                        }
                    }else{
                        popAlert(data['reason']);
                    }
                }
            })
                .catch(error => console.error(error))
        }
    });   

});


function listenfordata(ids){
    let data = {}; 
    for (let i = 0; i < ids.length; i++) {
        const id = ids[i];
        data[id] = $('#'+id + " input").val();        
    }
    return data;
}


  