$(document).ready(function(){

    let submit_clickable = true;
    $('#submit').click(function(){
        if (submit_clickable){      
            submit_clickable = false;  
            $('#submit').text('Updating...');
            $('.error').remove();

            let message = $('#message').val();

            if (message == ''){
                $('#submit').text('Update');
                submit_clickable = true;  
                popAlert('Enter something about you!');
                
                return '';
            }
            
            axios({
                method: 'POST',
                url: './api/user/update',
                headers: {
                    "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
                },
                data: {
                    updset:{
                        description: message
                    },
                    updpair:['code', sessionStorage.getItem('user')]
                }
            }).then(response => {
                const data = response.data;
                $('#submit').text('Submit');
                submit_clickable = true;  

                if (data['response'] === 'passed'){
                    popAlert("Description updated");
                }else{
                    console.log(response);
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


  