@extends ('layouts.base')

@section('moreheads')

@endsection('moreheads') 
 

@section('content')

    <main>
        <section class="featured section-padding" id="section_3" style="padding-top: 150px;">

            <div class="container">
                <div class="row" style="border-bottom: 1px dashed green; justify-content: right;">
                    <div class="col-lg-7 col-12">
                        <div class="">
                            <h1 style="font-weight:1000;text-align: right;font-size: 25px;letter-spacing:4px">Create food ticket</h1>               
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
                                <h4 class="mb-0 event-head">Food type
                                </h4>
                            </div>

                            <form method="get" class="custom-form contact-form" role="form">
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-lg-12 col-12">
                                        <input class="form-control" id="name" name="name" placeholder="Lunch/Breakfast/Supper"></input>
                                    </div>

                                </div>
                            </form>
                        </div>
                        
                    </div>
                    

                    <div class="col-lg-6 col-12" style="margin: 20px 0; display:none" >
                        <div id="errortab" class="errortaab" style="padding: 10px; border-radius: 5px; background-color:white; margin: 20px 0;" >
                        </div>
                    </div>
                    
                    <div style="margin-left:0px" class="custom-form contact-form">
                        <div style="text-align:center" id="queue" class="form-control">Activate</div>
                    </div>

                    
                    
                </div>
            </div>
        </section>
        
    </main>

@endsection('content')

@section('morebase')  
    <link href="<?php echo asset('css\eventdetail.css')?>" rel="stylesheet">
    <script src="<?php echo asset('js\request.js')?>"></script>
@endsection('morebase')