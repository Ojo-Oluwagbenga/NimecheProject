@extends ('layouts.base')

@section('moreheads')
    <meta name="pagecode" content="{{$data->code}}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
@endsection('moreheads') 

@section('content')
    <main>
        <section class="featured section-padding" id="section_3" style="padding-top: 150px;">
            <div class="container">
                <div class="row" style="border-bottom: 1px dashed green; justify-content: right;">
                    <div class="col-lg-7 col-12">
                        <div class="">
                            <h1 style="font-weight:1000;text-align: right;font-size: 25px;letter-spacing:4px">{{$data->name}}</h1>               
                            <style>
                                @media screen and (max-width: 480px){
                                    .featured{
                                        padding-top: 195px !important;
                                    }
                                }
                            </style>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb" style="border: none">
                            <div class="profile-title" style="padding: 20px; border:none;">
                                <h4 class="mb-0 event-head">Event Description
                                </h4>
                            </div>

                            <div class="profile-body" style="padding: 20px">
                                {{$data->description}}
                            </div>
                        </div>
                        
                    </div>

                    <div for="ResourcesSuper" id="eresourceID"  class="col-lg-6 col-12 vueport" style="margin: 20px 0">
                        <div style="padding: 10px; border-radius: 5px; background-color:white; margin: 20px 0" >
                            <h5 class="mb-0 event-head" style="font-size: 28px; padding: 20px"> Event Resources </h5>
                            <div class="eresource">
                                <span>F</span>
                                <span>Display contef or prof oluwajer</span>
                                <div class="c-vert event-full">
                                    <svg height=10px xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                </div>
                            </div>
                            <div class="eresource">
                                <span>F</span>
                                <span>Display contef or prof oluwajer</span>
                            </div>
                            <div class="eresource">
                                <span>F</span>
                                <span>Display contef or prof oluwajer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb">
                            <div class="profile-title">
                                <h4 class="mb-0">Event Bio</h4>
                            </div>

                            <div class="profile-body">
                                <p>
                                    <span class="profile-small-title">Date</span> 
                                    <span>{{$data->date}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Time</span> 
                                    <span>{{$data->time}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Duration</span> 
                                        <span><a href="#">{{$data->duration}}</a></span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Anchor</span> 
                                    <span><a href="#">{{$data->anchor}}</a></span>
                                </p>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb" style="border: none">
                            <div class="profile-title" style="padding: 20px; border:none;">
                                <h4 class="mb-0 event-head">Location
                                </h4>
                            </div>

                            <div class="profile-body" style="padding: 20px">
                                {{$data->location}}
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>

        <section for="CommentsSuper" id="section_5" class="contact section-padding vueport">
            
        </section>

        

    </main>
@endsection('content')

@section('morebase')  
    <link href="<?php echo asset('css\eventdetail.css')?>" rel="stylesheet">
    <script src="<?php echo asset('js\event.js')?>"></script>
@endsection('morebase')