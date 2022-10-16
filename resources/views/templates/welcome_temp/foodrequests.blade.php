@extends ('layouts.base')

@section('moreheads')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    
    <meta name="sharercode" content="{{$data['sharer']}}">
    
@endsection('moreheads') 

@section('content')
    <main>

        <div class="col-lg-7 col-12 usertab">
            <div class="hero-text">
                <div class="hero-title-wrap d-flex align-items-center mb-4">
                    <img src="<?php echo asset('templateasset\welcome\images/nimeche_logo.jpg') ?>" class="avatar-image avatar-image-large img-fluid" alt="">

                    <h1 class="hero-title ms-3 mb-0">Sharer 1</h1>
                </div>                    
            </div>
        </div> 

        <section style="padding-top:150px" for="FoodrequestsSuper" class="vueport featured section-padding eventssuper" id="section_3">

        </section>
    </main>
@endsection('content')