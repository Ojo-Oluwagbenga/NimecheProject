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
        
        <link href="<?php echo asset('css\dashboard.css')?>" rel="stylesheet">

        <meta name="_token" content="{{ csrf_token() }}">
        
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>  

        @vite(['resources/js/app.js', 'resources/css/app.css'])

    </head>
    
    <body>

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
                            <a class="nav-link click-scroll" href="#section_2">Event Guide</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Timeline</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Excos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">Contact</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="/login">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="/start">Start</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>

        <main>

            <section class="hero d-flex justify-content-center align-items-center" id="section_1">
                <div class="container" style="overflow:visible">
                    <div class="row">

                        <div class="col-lg-7 col-12">
                            <div class="hero-text">
                                <div class="hero-title-wrap d-flex align-items-center mb-4">
                                    <img src="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg') ?>" class="avatar-image avatar-image-large img-fluid" alt="">

                                    <h1 class="hero-title ms-3 mb-0">Welcome!</h1>
                                </div>

                                <h2 class="mb-4">35th International Conference & Annual General Meeting</h2>
                                
                                <div class="authhold">
                                    <p class="mb-4"><a class="custom-btn btn custom-link" href="/start">Start here</a></p>
                                    <p class="mb-4"><a class="custom-btn btn custom-link" href="/login">Login</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-12 position-relative">
                            <div class="hero-image-wrap">
                                <img src="<?php echo asset('templateasset\welcome\images/enginemark.jpg') ?>" class="hero-image img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill-opacity="1" d="M0,160L24,160C48,160,96,160,144,138.7C192,117,240,75,288,64C336,53,384,75,432,106.7C480,139,528,181,576,208C624,235,672,245,720,240C768,235,816,213,864,186.7C912,160,960,128,1008,133.3C1056,139,1104,181,1152,202.7C1200,224,1248,224,1296,197.3C1344,171,1392,117,1416,90.7L1440,64L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z"></path></svg>
            </section>


            <section class="about section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="about-thumb">

                                <div class="section-title-wrap d-flex justify-content-end align-items-center mb-4">
                                    <img src="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg') ?>" class="avatar-image img-fluid" alt="">
                                    <h2 class="text-white me-4 mb-0">Conference Guide</h2>
                                    
                                </div>

                                <h3 class="pt-2 mb-3">A glimpse to the events</h3>

                                <p style="padding:10px">
                                    The Nigerian Institution of Mechanical Engineers
                                    ( A division of The Nigerian Society of Engineers)
                                    National Students' Forum welcomes you to the 35th International Conference & Annual General Meeting.
                                   <br><br>
                                    The event aims at educating on <strong>The Impact of digitalization on mechanical engineering.</strong> We hope you get the best out of every moment of the event. Stay connected.
                                </p>
                            </div>
                            
                        </div>
                        <div class="about-thumb more-det" style="width: 50%;">
                            <h3 class="pt-2 mb-3">Basic Instructions</h3>

                            <p style="padding:10px">
                                To ensure better running of the AGM programme, we are delighted to introduce you to the conference application.
                                The web application caters for each attendees room number and meal tickets.
                                We urge every attendee of this year's conference to onboard their details to the site.<br><br>We wish you an educative stay.
                            </p>
                        </div>

                    </div>
                </div>
            </section>
            
            <section for="EventsSuper" class="vueport featured section-padding eventssuper" id="section_3">

            </section>

            <section class="projects section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-md-8 col-12 ms-auto">
                            <div class="section-title-wrap d-flex justify-content-center align-items-center mb-4">
                                <img src="<?php echo asset('templateasset\welcome\images/white-desk-work-study-aesthetics.jpg') ?>" class="avatar-image img-fluid" alt="">

                                <h2 class="text-white ms-4 mb-0">Meet the Excos</h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF President</small>

                                    <h3 class="projects-title">Abuh Rasheed ENECHEJO</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-rasheed.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-rasheed.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF General Secretary</small>

                                    <h3 class="projects-title">Akinwale Oluwadamilare Elijah</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-elijah.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-elijah.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF Welfare Secretary</small>

                                    <h3 class="projects-title">Na'allah VICTOR Tychicus</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-victor.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-victor.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF Treasurer</small>

                                    <h3 class="projects-title">NUMBE A. Godwin</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-godwin.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-godwin.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        
                          
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF Publicity Secretary</small>

                                    <h3 class="projects-title">ADAMS Muhammad</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-adams.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-adams.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>   

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF MEMBERSHIP SECRETARY</small>

                                    <h3 class="projects-title">SULAIMAN Shehu</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-shehu.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-shehu.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF Editor-in-Chief / Product Designer</small>

                                    <h3 class="projects-title">DAVID Echefulam Echendu</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-david.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-david.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>   
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">NSF SYSTEM ARCHITECT AND DEVELOPER</small>

                                    <h3 class="projects-title">JOHN O. Oluwagbenga</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/v-john.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/v-john.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
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
        <script src="<?php echo asset('templateasset\welcome\js/jquery.min.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/bootstrap.min.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/jquery.sticky.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/click-scroll.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/jquery.magnific-popup.min.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/magnific-popup-options.js')?> "></script>
        <script src="<?php echo asset('templateasset\welcome\js/custom.js')?> "></script>

    </body>
</html>