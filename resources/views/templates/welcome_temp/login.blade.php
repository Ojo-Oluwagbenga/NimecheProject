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
        <script src="<?php echo asset('js\login.js')?>" ></script>               
         
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

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="/welcome" style="margin-bottom:20px">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/start" style="margin-bottom:20px">Create account</a>
                        </li>
                        
                    </ul>
                </div>

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
                                    <div id="emailorcode" class="">
                                        <div  class="form-floating">                                            
                                            <input type="text" name="emailorcode" class="form-control" placeholder="Email address or Code" required="">
                                            
                                            <label for="floatingInput">Email address</label>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="row" >

                                        <div id="password" class="">
                                            <div class="form-floating">
                                            <input type="password" name="password" class="form-control" placeholder="Set A Password" required="">
                                                
                                                <label for="floatingInput">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-12 ms-auto">
                                            <div id="submit" class="submit form-control">Login</div>
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