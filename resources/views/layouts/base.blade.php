<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>NIMechE Student</title>
        <link rel="icon" type="image/png" href="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg')?> "/>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/bootstrap.min.css')?> " rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/bootstrap-icons.css')?> " rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/magnific-popup.css')?> " rel="stylesheet">

        <link href="<?php echo asset('templateasset\welcome\css/templatemo-first-portfolio-style.css')?>" rel="stylesheet">
        
        <link href="<?php echo asset('css\dashboard.css')?>" rel="stylesheet">

        <meta name="_token" content="{{ csrf_token() }}">
        
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>  

        <script src="<?php echo asset('templateasset\welcome\js/jquery.min.js')?> "></script>
        
        @yield('moreheads')


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
                    padding: 5px 15px;
                    border-radius: 5px;
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

                <a class="navbar-brand mx-auto mx-lg-0">NIMechE Student</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="/dashboard" style="margin-bottom:20px">Dashboard</a>
                        </li>
                        
                        @if($data['access']=='admin')
                            <li class="nav-item">
                                <a class="nav-link" href="/createevent" style="margin-bottom:20px">Create event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/foodcreate" style="margin-bottom:20px">Create Ticket</a>
                            </li>
                        @endif

                        @if($data['foodaccess']=='true')
                            <li class="nav-item">
                                <a class="nav-link" href="/foodrequests" style="margin-bottom:20px">Food Requests</a>
                            </li>
                        @endif


                        <li class="nav-item">
                            <a id="logout" class="nav-link" style="margin-bottom:20px">Log out</a>
                        </li>
                        <script>
                            $("#logout").click(function(){
                                sessionStorage.clear();
                                window.location.href = '/logout';
                            });
                        </script>
                        
                    </ul>
                    
                </div>

                <div class="d-flex align-items-center d-lg-none">
                    <a class="custom-btn btn" href="/myaccount">
                        My Account
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    

                    <div class="d-lg-flex align-items-center d-none ms-auto">
                        <a class="custom-btn btn" href="/myaccount">
                            My Account
                        </a>
                    </div>
                </div>

            </div>
        </nav>

        <div style="height: 50px"></div>

        @yield ('content')

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12">
                        <div class="copyright-text-wrap">
                            <p class="mb-0">
                                <span class="copyright-text">Copyright © 2022 <a href="#"> NIMechE student </a></span> 
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
        <script src="<?php echo asset('templateasset\welcome\js/click-scroll.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/jquery.magnific-popup.min.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/magnific-popup-options.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/custom.js')?> "></script>
        @yield('morebase')
    </body>
</html>