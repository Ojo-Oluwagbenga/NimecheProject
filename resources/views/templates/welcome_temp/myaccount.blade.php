@extends ('layouts.base')

@section('moreheads')
    <link href="<?php echo asset('css\myaccount.css')?>" rel="stylesheet">    
    <script src="<?php echo asset('js\myaccount.js')?>"></script>    
@endsection('moreheads') 

@section('content')

    <main>
        <section class="featured section-padding" id="section_3" style="padding-top: 150px;">

            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12 usertab">
                        <div class="hero-text">
                            <h1 style="font-size: 35px; font-weight:1000; padding: 10px 0">Welcome Back!</h1>  
                            <div class="hero-title-wrap d-flex align-items-center mb-4">
                                <img src="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg') ?>" class="avatar-image avatar-image-large img-fluid" alt="">

                                <h1 class="hero-title ms-3 mb-0">{{$data->name}}</h1>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb">
                            <div class="profile-title">
                                <h4 class="mb-0 event-head">Student Bio
                                    <!-- <div class="c-vert event-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                    </div> -->
                                </h4>
                            </div>

                            <div class="profile-body">
                                <style>
                                    .profile-body p{
                                        display:flex;
                                    }
                                </style>
                                <p>
                                    <span class="profile-small-title">Name</span> 
                                    <span class="c-vert">{{$data->name}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Sex</span> 
                                    <span class="c-vert">{{$data->gender}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Institution</span> 
                                        <span class="c-vert">{{$data->institution}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Code</span> 
                                    <span class="c-vert">{{$data->code}}</span>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb">
                            <div class="profile-title">
                                <h4 class="mb-0">Accomodation Details</h4>
                            </div>

                            <div class="profile-body">
                                <p>
                                    <span class="profile-small-title">Hostel Name</span> 
                                    <span class="c-vert">{{$data->hostel}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Block</span> 
                                    <span class="c-vert">Block {{$data->block}}</span>
                                </p>
                                
                                <p>
                                    <span class="profile-small-title">Room</span> 
                                    <span class="c-vert"><a href="#">Room {{$data->room}}</a></span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Bunk</span> 
                                    <span class="c-vert"><a href="#">Bunk {{$data->bunk}}</a></span>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    

                </div>
            </div>
        </section>

        <section class="contact section-padding" id="section_5">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                        <form action="#" method="get" class="custom-form contact-form" role="form">
                            <div class="row">
                                <h1 style="padding-bottom: 20px">
                                    Connect with new people!
                                </h1>
                                <span style="padding-bottom: 10px; color: grey">
                                    Share a short description of yourself to help other students find and connect with you.
                                    <br>e.g Your nickname, topics you are interested in, and most importantly your <strong>phone number</strong>
                                </span>
                                <div class="col-lg-12 col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" placeholder="ddffrfe">{{$data->description}}</textarea>
                                        
                                        <label for="floatingTextarea">Description</label>
                                    </div>
                                </div> 

                                <div class="col-lg-3 col-12 ms-auto">
                                    <div style="text-align:center" id="submit" class="form-control">Update</div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                </div>
            </div>  
        </section>

    </main>
@endsection('content')
