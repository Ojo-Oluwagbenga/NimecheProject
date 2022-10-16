<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Api</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    Test Protocol
    
    <div class="init" style="width:100px; height: 40px; background-color: green; border-radius: 5px"></div>
    
    <script>
        $('div.init').click(function(){
            axios({
                method: 'POST',
                url: './api/user/loadaccepts_token',
                headers: {
                    "X-CSRF-TOKEN" : '{{csrf_token()}}'
                },
                data: {
                    querypair:{'id':'1'},
                    fetchset:['name']

                }
            }).then(response => {console.log(response)})
                .catch(error => console.error(error))
        })
               
    </script>
    
</body>
</html>