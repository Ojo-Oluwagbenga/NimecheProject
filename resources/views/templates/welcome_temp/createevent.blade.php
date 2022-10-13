@extends ('layouts.base')

@section('content')

    <main>
        <section class="featured section-padding" id="section_3" style="padding-top: 150px;">

            <div class="container">
                <div class="row" style="border-bottom: 1px dashed green; justify-content: right;">
                    <div class="col-lg-7 col-12">
                        <div class="">
                            <h1 style="font-weight:1000;text-align: right;font-size: 25px;letter-spacing:4px">Edit event</h1>               
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
                                <h4 class="mb-0 event-head">Event head
                                </h4>
                            </div>

                            <form method="get" class="custom-form contact-form" role="form">
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-lg-12 col-12">
                                        <input class="form-control" id="name" name="name" placeholder="Event Name"></input>

                                        <input class="form-control" id="location" name="location" placeholder="Event Location"></input>
                                        
                                        <div class="form-floating">
                                            <textarea class="form-control" id="description" name="message" placeholder="ddffrfe"></textarea>
                                            
                                            <label for="floatingTextarea">Add a decription of this event</label>
                                        </div> 
                                      

                                    </div>

                                </div>
                            </form>
                        </div>
                        
                    </div>

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div class="profile-thumb">
                            <div class="profile-title">
                                <h4 class="mb-0">Event Bio</h4>
                            </div>

                            <div class="profile-body">
                                <style>
                                    .profile-thumb p input{
                                        padding:5px; 
                                        outline:none; 
                                        border:1px dashed grey;
                                        width: 95%; margin:0px auto; 
                                        border-radius:5px;"
                                    }
                                    .profile-thumb p input:focus{
                                        border:2px dashed grey;
                                    }
                                </style>
                                <p style="display:flex">
                                    <span class="profile-small-title">Date</span> 
                                    <span style="width:100%" class="c-vert">
                                        <input id="date" type="text" />
                                    </span>                                    
                                </p>

                                <p style="display:flex">
                                    <span class="profile-small-title">Time</span> 
                                    <span style="width:100%" class="c-vert">
                                        <input id="time" type="text" />
                                    </span>                                    
                                </p>

                                <p style="display:flex">
                                    <span class="profile-small-title">Duration</span> 
                                    <span style="width:100%" class="c-vert">
                                        <input id="duration" type="text" />
                                    </span>                                    
                                </p>

                                <p style="display:flex">
                                    <span class="profile-small-title">Anchor</span> 
                                    <span style="width:100%" class="c-vert">
                                        <input id="anchor" type="text" />
                                    </span>                                    
                                </p>

                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-6 col-12" style="margin: 20px 0">
                        <div style="padding: 10px; border-radius: 5px; background-color:white; margin: 20px 0" >
                            <h5 id="resourcehead" class="mb-0 event-head" style="font-size: 28px; padding: 20px"> Event Resources </h5>
                                                        
                            <div id="resourceadder" class="eresource" style="padding:20x">
                                <span>
                                    <svg height=10px xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                </span>

                                <span style="position:relative">
                                    <span> Add new pdf material</span>
                                    <input style="opacity:0;left:0;z-index:2; height:100%; width:100%; top:0px; position:absolute" type='file' id="up_file" name='file' accept="application/pdf,application/vnd.ms-excel">
                                </span>
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-12" style="margin: 20px 0; display:none" >
                        <div id="errortab" class="errortaab" style="padding: 10px; border-radius: 5px; background-color:white; margin: 20px 0;" >
                        </div>
                    </div>
                    

                    <div style="margin-left:0px" class="custom-form contact-form">
                        <div style="text-align:center" id="queue" class="form-control">Queue</div>
                    </div>

                    
                    
                </div>
            </div>
        </section>
        
    </main>

@endsection('content')

@section('morebase')  
    <link href="<?php echo asset('css\eventdetail.css')?>" rel="stylesheet">
    <script src="<?php echo asset('js\event.js')?>"></script>
@endsection('morebase')