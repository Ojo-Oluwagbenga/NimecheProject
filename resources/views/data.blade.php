<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
</head>
<body>
    
    <!-- <div class="init" style="width:100px; height: 40px; background-color: green; border-radius: 5px"></div> -->
    
    <div class="supercont">
        <h2 id="pgname" class="head">NIMechE Food List For Lunch</h2>

        <div class="listpack" id="listpackid">

        </div>
        
    </div>
    
    <style>
        .supercont{
            font-family: 'PT Sans', sans-serif;
            width: 95vw;
            border: 2px dashed grey;
            border-radius: 10px 0px;
        }
        .supercont .head{
            text-align: center;
            padding: 5px;
        }
        .supercont .listpack{
            /* display:flex; */
        }
        .itempack {
            width: 90%;
            border-radius: 10px;
            background-color: whitesmoke;
            padding: 10px;
            margin: 30px auto;

        }
        .itempack .itemhead{
            display: flex;
            border-bottom: 1px dashed grey;
            padding: 30px 0px;
        }
        .itempack .itemhead > :nth-child(n){
            text-align:center;
        }
        .itempack .itemhead .token{
            width: 45%
        }
        .itempack .itemhead .useremail{
            width: 55%
        }
        .itempack .itemhead .token{
            border-right: 1px solid grey;
        }
        .itempack .itemhead > div:nth-child(n){
            margin: 10px 0;
        }
    </style>
    <script>
        function getCollectData(){
            let url = window.location.origin + '/api/user/getcollectdata';
            axios({
                method: 'POST',
                url: url,
                headers: {
                    'Cache-Control': 'no-cache',
                    "X-CSRF-TOKEN" : '{{csrf_token()}}'
                },
                data: {

                },
            }).then(response => {
                console.log(response);
                $("#pgname").text(response.data.ticketname);
                interprete(response.data, 'user_collected', 'Collected');
                interprete(response.data, 'user_waiting', 'Waiting');
                interprete(response.data, 'user_not_collected', 'Not collecting');
            }).catch(error => console.error(error))
                
        }

        let udata = getCollectData();

        function interprete(udata, type, name){
            for (let i = 0; i < 1; i++) {
                let el = '<div class="itempack" id="itemhold'+i+type+'">'+
                            '<h2 style="text-align:center">'+name+' ('+udata[type].length+')'+'</h2>'+
                            '<div class="itemhead">'+
                                '<h4 class="token">Name</h4>'+
                                '<h4 class="token">Code</h4>'+
                                '<h4 class="useremail">Institution</h4>'+
                            '</div>'+
                        '</div>';

                $("#listpackid").append(el);

                let collected = udata[type];
                for (let j = 0; j < collected.length; j++) {
                    let user = collected[j];
                    let el = '<div class="itemhead">'+
                                '<div class="token">'+user['name']+'</div>'+
                                '<div class="token">'+user['code']+'</div>'+
                                '<div class="useremail"><b>'+user['institution']+'</b></div>'+
                            '</div>';

                    $("#itemhold"+i+type).append(el)
                };
                
            }
        }

        
        
               
    </script>
    
</body>
</html>