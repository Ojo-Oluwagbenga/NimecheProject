@extends ('layouts.base')

@section('moreheads')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
@endsection('moreheads') 

@section('content')
        <main>

            <div class="col-lg-7 col-12 usertab">
                <div class="hero-text">
                    <div class="hero-title-wrap d-flex align-items-center mb-4">
                        <img src="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg') ?>" class="avatar-image avatar-image-large img-fluid" alt="">

                        <h1 class="hero-title ms-3 mb-0">Ojo Oluwagbenga John</h1>
                    </div>                    
                </div>
            </div> 

            <section for="EventsSuper" class="vueport featured section-padding eventssuper" id="section_3">

            </section>


            <section class="projects section-padding excossuper" id="section_4">
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
                                    <small class="projects-tag">President</small>

                                    <h3 class="projects-title">Adekunle Johnson</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/projects/nikhil-KO4io-eCAXA-unsplash.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/exco.png') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">Student Representative</small>

                                    <h3 class="projects-title">Omoloye Samuel</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/projects/the-5th-IQYR7N67dhM-unsplash.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/projects/the-5th-IQYR7N67dhM-unsplash.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">President</small>

                                    <h3 class="projects-title">Adekunle Johnson</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/projects/nikhil-KO4io-eCAXA-unsplash.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/exco.png') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">Student Representative</small>

                                    <h3 class="projects-title">Omoloye Samuel</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/projects/the-5th-IQYR7N67dhM-unsplash.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/projects/the-5th-IQYR7N67dhM-unsplash.jpg') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="projects-thumb">
                                <div class="projects-info">
                                    <small class="projects-tag">President</small>

                                    <h3 class="projects-title">Adekunle Johnson</h3>
                                </div>

                                <a href="<?php echo asset('templateasset\welcome\images/projects/nikhil-KO4io-eCAXA-unsplash.jpg') ?>" class="popup-image">
                                    <img src="<?php echo asset('templateasset\welcome\images/exco.png') ?>" class="projects-image img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        
                        

                    </div>
                </div>
            </section>

            <section class="contact section-padding connectssuper" id="section_5"  style="padding-bottom: 10px">
                <div class="container">
                    <div class="row">
                        <h1 style="padding-bottom: 20px; margin: 10px;">
                            Connect with new people!
                        </h1>
                        <span style="padding-bottom: 10px; color: grey; margin: 10px;">
                            Below are short description of people that are with you in the conference.
                            <br>Connect with as much as possible.<strong>You may add your own descriptions in your account page</strong>
                        </span>

                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="row" style="padding: 10px; background-color: white; border-radius: 10px;margin: 10px;">
                                <h5 style="padding-bottom: 20px">
                                    Ojo Oluwagbenga John
                                </h5>
                                <span style="padding-bottom: 10px; color: grey">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, recusandae rerum? Blanditiis, possimus. Ut excepturi sequi placeat ratione nisi? Et autem obcaecati nisi? Libero quia repellat tenetur distinctio quaerat amet!
                                </span>

                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="row" style="padding: 10px; background-color: white; border-radius: 10px;margin: 10px;">
                                <h5 style="padding-bottom: 20px">
                                    Ojo Oluwagbenga John
                                </h5>
                                <span style="padding-bottom: 10px; color: grey">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, recusandae rerum? Blanditiis, possimus. Ut excepturi sequi placeat ratione nisi? Et autem obcaecati nisi? Libero quia repellat tenetur distinctio quaerat amet!
                                </span>

                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                            <div class="row" style="padding: 10px; background-color: white; border-radius: 10px;margin: 10px;">
                                <h5 style="padding-bottom: 20px">
                                    Ojo Oluwagbenga John
                                </h5>
                                <span style="padding-bottom: 10px; color: grey">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, recusandae rerum? Blanditiis, possimus. Ut excepturi sequi placeat ratione nisi? Et autem obcaecati nisi? Libero quia repellat tenetur distinctio quaerat amet!
                                </span>

                            </div>
                        </div>

                    </div>
                </div>  
            </section>

        </main>
@endsection('content')
