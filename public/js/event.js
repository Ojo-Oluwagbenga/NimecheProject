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

    $('#up_file').on('input', function() {
        // let obj = ;
        let fileobj = $('#up_file')[0].files[0];
        if (typeof(fileobj) !== 'undefined'){
            if (fileobj.size < 2097152){
                resaddcount += 1;
                let name = fileobj.name;
                let el = '<div id="resadd'+resaddcount+'" class="eresource" style="padding:20x" num="'+resaddcount+'">'+
                                '<span class="resremove">'+
                                    '<svg style="height:14px; fill:red;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>'+
                                '</span>'+
                                
                                '<span style="position:relative">'+
                                    '<span> '+name+'</span>'+
                                '</span>'+                                
                            '</div>';

                addedfile['resadd'+resaddcount] = [fileobj, fileobj.name];
                $('#resourceadder').before(el);

                $('.resremove').click(function(){
                    delete addedfile[$(this).parent().attr('id')];
                    $(this).parent().remove();
                });
            }else{
                popAlert('File is too large');
            }       
        }else{
            console.log(typeof($('#file')[0]));
        }
        // console.log(.files[0].name);
    });

    let submit_clickable = true;
    $("#queue").click(function(){
        if (submit_clickable){      
            submit_clickable = false;  
            $('#queue').text('Submitting...');
            $('#errortab').parent().css("display", 'none');

            
            let data = listenfordata(['name', 'description', 'location', 'date', 'time', 'duration', 'anchor']);
            data['thoughts'] = JSON.stringify([]);
            data['resources'] = [];

            var fd = new FormData();
            
            let cc = 0;
            let itnames = [];
            for (const key in addedfile) {
                const file = addedfile[key][0];
                cc += 1;
                fd.append('file-'+ (cc), file);
                itnames.push( (cc) + "-" + addedfile[key][1]);
                
            }

            data['resources'] = JSON.stringify(itnames);

            fd.append('createset',JSON.stringify(data));
            fd.append('upldcount', cc);

            axios({
                method: 'POST',
                url: "./api/event/addnew",
                headers: {
                    "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
                },
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
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
    // message_comment
    // $("#comment_submit").click(function(){
    //     let message = $("#message_comment").val();
    //     axios({
    //         method: 'POST',
    //         url: "./api/event/addnew",
    //         headers: {
    //             "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
    //         },
    //         data: fd,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //     }).then(response => {
    //         $('#queue').text('Queue');
    //         const data = response.data;
    //         submit_clickable = true;  

    //         console.log(response);

    //         if (data['response'] === 'passed'){
    //             popAlert('Event created!');
    //             window.location.href = './dashboard';
    //         }else{
    //             if ((data['reason'] === 'valerror')){
    //                 let errs = JSON.parse(data['data']);
                    
    //                 console.log(errs);
    //                 let errtext = '';

    //                 for (const key in errs) {
    //                     errtext += '<li class="error">'+errs[key][0]+'</li>';
    //                 }
    //                 $('#errortab').parent().css("display", 'block');
    //                 $('#errortab').html(errtext);
    //             }
    //         }
    //     })
    // })

})