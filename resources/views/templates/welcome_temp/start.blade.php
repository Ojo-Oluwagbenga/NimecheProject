<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Nimeche Student</title>
        <link rel="icon" type="image/png" href="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg')?> "/>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/bootstrap.min.css')?> " rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/bootstrap-icons.css')?> " rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/magnific-popup.css')?> " rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/templatemo-first-portfolio-style.css')?>" rel="stylesheet">
        
        <meta name="_token" content="{{ csrf_token() }}">
        
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="<?php echo asset('templateasset\welcome\js/jquery.min.js')?> "></script>
            
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="<?php echo asset('js\auth.js')?>" ></script>               
        
    </head>
    
    <body> 
        <div class="popalertBox">
            <style>
                .popalertBox{
                    position: fixed;
                    width: 100vw;
                    bottom: 60px;
                    display: none;
                    z-index: 220;
                }
                .popalertBox .mypop{
                    width: max-content;
                    margin: 0px auto;
                    padding: 10px;
                    border-radius: 10px;
                    background-color: #343434;
                    transition: opacity 0.3s ease-in;
                    color: white;
                    /* font-family: "Open Sans Condensed", sans-serif; */
                    font-size: 15px;
                    font-weight: bold;
                    opacity:1;
                }
            </style>
            <div class="mypop">Pop Here</div>
            <script>
                function popAlert(text){
                    $(".popalertBox").css('display', 'block');
                    $(".popalertBox .mypop").css('opacity', '1').text(text);
                    setTimeout(() => {
                        $(".popalertBox .mypop").css('opacity', '0');
                        setTimeout(() => {
                            $(".popalertBox").css('display', 'none');
                        }, 400);
                    }, 2000);
                }
            </script>
        </div>

        <section class="preloader">
            <div class="spinner">
                <span class="spinner-rotate"></span>    
            </div>
        </section>

        
        
        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a style="color:black" class="navbar-brand mx-auto mx-lg-0">NiMeche Students</a>

            </div>
        </nav>   
 
        <main> 
            
            <section style="position:relative; z-index:2; background:none" class="contact section-padding" id="section_5">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                                <div class="contact-info d-flex flex-column">
                                    <strong class="site-footer-title d-block mb-3">About </strong>

                                    <p class="mb-2">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam mollitia deleniti eveniet nisi aliquam enim laboriosam est consequuntur, earum vel animi labore officia inventore error quae facilis provident ab. Ex quisquam tempora impedit. Esse dolore in hic praesentium, natus aliquid. Laborum assumenda natus aliquid eius facilis ipsum ad sint numquam.
                                    </p>

                                </div>
                            </div>

                            <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                                <form class="custom-form contact-form" role="form">
                                    <div id="code" class="">
                                        <!-- <div class="error">Jey</div> -->
                                        <div  class="form-floating">                                            
                                            <input type="text" name="name" class="form-control" placeholder="Name" required="">
                                            
                                            <label for="floatingInput">Code</label>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="row" >
                                        <div id="name" class="col-lg-6 col-md-6 col-12">
                                            <div class="form-floating">
                                                <input type="text" name="name" class="form-control" placeholder="Name" required="">
                                                
                                                <label for="floatingInput">Name</label>
                                            </div>
                                        </div>

                                        <div id="email" class="col-lg-6 col-md-6 col-12"> 
                                            <div class="form-floating">
                                                <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">
                                                
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                        </div>

                                        
                                        <div id="gender" class="orderbybox">
                                            <div class="orderbyhead" >
                                                <span style="position:relative;margin:unset" class="centerVert">Select Gender</span>
                                            </div>
                                            <div class="orderbybutTab">
                                                <div class="orderbybut" mychecked=0 gend='m'>
                                                    <div class="obhold"><div class="obname centerVert">Male</div><div class="obcircle centerVert"></div></div>
                                                </div>
                                                <div class="orderbybut" mychecked=0 gend='f'>
                                                    <div class="obhold"><div class="obname centerVert">Female</div><div class="obcircle centerVert"></div></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="institution" class="providerSelectBox itembox" id="providersuper">
                                            <div class="nameBar">
                                                Select Institution
                                            </div>
                                            <div  style="padding:10px;display:flex;justify-content: space-evenly;border: 2px solid var(--border-color);border-bottom: none;border-radius: 10px 0px 0px 0px;">
                                                <input id='schoolsearch' style=" padding:5px;width: 70%; outline:none; border:none" placeholder="Enter any consecutive letters here" type="text"> 
                                                <span id='schoolfilter' style="width: 20%; border-radius: 5px; color: green; padding:5px; cursor:pointer;font-weight: bold;">Filter</span>
                                            </div>
                                            <div class="ddhold" id="university" openstate=0 style="border-top: 2px dashed var(--border-color);; border-radius: 0 0 10px 0">
                                
                                                <span class="name">Obafemi Awolowo University</span>
                                                <span  style="display:none" class="svghold"><svg style="height:14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg><span>
                                            </div>

                                            <div class="dropdownwrap">
                                                <div class="dropdown">
                                                    <div class="dditem" bio="mtn">MTN</div>
                                                </div>
                                            </div>
                                            

                                        </div>

                                        <style>
                                            .nameBar{
                                                padding: 10px 0px ;
                                                font-weight: bold;
                                                font-size: 14px;
                                                width: 95%;
                                                margin: 0px auto;
                                            }

                                            .providerSelectBox{
                                                position: relative;
                                                margin: 10px 0px;
                                            }
                                            .ddhold{
                                                position: relative;
                                                width: 100%;
                                                height: 65px;
                                                /* box-shadow: 0px 1px 3px grey;
                                                */
                                                border: 2px solid var(--border-color);
                                                display: flex;
                                                z-index: 2;
                                                font-weight: bold;
                                                position: relative;
                                                font-size: 14px;
                                                flex-direction: column;
                                                text-align: center;
                                                border-radius: 10px 0;
                                                margin: 0px auto;
                                                justify-content: center;
                                            }
                                            .ddhold > span:nth-child(2){
                                                position: absolute;
                                                right: 2%;
                                            }
                                            .ddhold > span > i{
                                                transform: rotateZ(90deg);
                                            }
                                            .dropdownwrap{
                                                position: absolute;
                                                width: 100%;
                                                left: 0px;
                                                top: calc(100% + 6px);
                                                display: flex;
                                                justify-content: center;
                                            }
                                            .dropdown{
                                                width: 95%;
                                                height: 0px;
                                                position: relative;
                                                z-index: 3;
                                                transition: height 0.2s ease-in;
                                                box-shadow: 0px 1px 3px grey;
                                                margin: 5px auto;
                                                max-height: 200px;
                                                overflow: auto;
                                                display: block;
                                                background-color:white;
                                            }
                                            .dropdown .dditem{
                                                height: 60px;
                                                text-align: center;
                                                width: 80%;
                                                font-size: 14px;
                                                font-weight: bold;
                                                display: flex;
                                                flex-direction: column;
                                                padding: 10px;
                                                justify-content: center;
                                                border : 1px dashed #d3d3d3;
                                                border-radius: 5px;
                                                margin: 10px auto;
                                                cursor: pointer;
                                            }

                                            .orderbybox{
                                                margin: 10px 0px;
                                                width: 100%;
                                                /* height: 100px; */
                                            }
                                            .orderbybox .orderbyhead{
                                                padding: 5px;
                                                width: 95%;
                                                font-weight: bold;
                                                margin: 0px auto;
                                                display: flex;
                                                font-size: 13px;
                                            }
                                            .orderbybox .orderbyhead span:nth-child(2){
                                                margin: 0px 15px; 
                                                font-weight:normal; 
                                                box-shadow: 0px 1px 3px -1px grey;
                                                color: rgb(0, 0, 131);
                                                padding:5px; 
                                                border-radius: 0px 0px 5px 5px;
                                                cursor: pointer;
                                            } 
                                            .orderbybox .orderbybutTab{
                                                display: flex;
                                                font-size: 12px;
                                                /* height: 70%; */
                                            }
                                            .orderbybox .orderbybut{
                                                display: flex;
                                                width: calc(100%/3);
                                                justify-content: space-around;
                                                padding: 10px;
                                            }
                                            .orderbybox .orderbybut .obhold {
                                                display: flex;
                                                cursor: pointer;
                                            }
                                            .orderbybox .orderbybut .obhold :nth-child(n) {
                                                margin-left: 5px;
                                                margin-right: 5px;
                                            }
                                            .orderbybox .orderbybut .obcircle {
                                                height: 20px;
                                                width: 20px;
                                                border:1px solid grey;
                                                border-radius: 50%;
                                            }
                                            .orderbybox .orderbybut .obname {
                                                font-size: 14px;
                                            }
                                        </style>

                                        <div id="password" class="">
                                            <div class="form-floating">
                                            <input type="password" name="password" class="form-control" placeholder="Set A Password" required="">
                                                
                                                <label for="floatingInput">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-12 ms-auto">
                                            <div id="submit" class="submit form-control">Send</div>
                                        </div>

                                       
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="copyright-text-wrap">
                            <p class="mb-0">
                                <span class="copyright-text">Copyright © 2022 <a href="#"> NiMechE student </a></span> 
                                <br>
                                All rights reserved.
                                
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="<?php echo asset('templateasset\welcome\js/bootstrap.min.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/jquery.sticky.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/jquery.magnific-popup.min.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/magnific-popup-options.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/custom.js')?> "></script>

    </body>
</html>