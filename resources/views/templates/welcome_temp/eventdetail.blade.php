@extends ('layouts.base')

@section('moreheads')
    <meta name="pagecode" content="{{$data['code']}}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
@endsection('moreheads') 
 
@section('content')
    <main>
        <section class="featured section-padding" id="section_3" style="padding-top: 150px;">
            <div class="container">
                <div class="row" style="border-bottom: 1px dashed green; justify-content: right;">
                    <div class="col-lg-7 col-12">
                        <div class="">
                            <h1 style="font-weight:1000;text-align: right;font-size: 25px;letter-spacing:4px">{{$data['name']}}</h1>               
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
                                {{$data['description']}}
                            </div>
                        </div>
                        
                    </div>

                    <div for="ResourcesSuper" id="eresourceID"  class="col-lg-6 col-12 vueport" style="margin: 20px 0">
                        
                    </div>

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb">
                            <div class="profile-title">
                                <h4 class="mb-0">Event Bio</h4>
                            </div>

                            <div class="profile-body">
                                <p>
                                    <span class="profile-small-title">Date</span> 
                                    <span>{{$data['date']}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Time</span> 
                                    <span>{{$data['time']}}</span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Duration</span> 
                                        <span><a href="#">{{$data['duration']}}</a></span>
                                </p>

                                <p>
                                    <span class="profile-small-title">Anchor</span> 
                                    <span><a href="#">{{$data['anchor']}}</a></span>
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
                                {{$data['location']}}
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>

        @if($data['access']=='admin')
            <section class="section-padding" style="padding-top: 150px;">
                <div class="container" style="overflow-x:scroll">
                    <div class="evstatus">
                        <h3 class="c-vert name">Status</h3>
                        <div state="2" style="background-color:black" class="c-vert stat">Done</div>
                        <div state="1" style="background-color:green" class="c-vert stat">Start</div>
                        <div state="0" style="background-color:#d7d705" class="c-vert stat">Queue</div>
                        <div state="3" style="background-color:red" class="c-vert stat">Del</div>
                    </div>
                </div>
            </section>
        @endif                                
        

        <section for="CommentsSuper" id="section_5" class="contact section-padding vueport">
            
        </section>

        

    </main>
@endsection('content')

@section('morebase')  
    <link href="<?php echo asset('css\eventdetail.css')?>" rel="stylesheet">
    <script src="<?php echo asset('js\event.js')?>"></script>
@endsection('morebase')