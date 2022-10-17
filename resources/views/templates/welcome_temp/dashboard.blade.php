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

                        <h1 class="hero-title ms-3 mb-0">{{$data['name']}}</h1>
                    </div>                    
                </div>
            </div> 

            <section for="EventsSuper" class="vueport featured section-padding eventssuper" id="section_3">

            </section>

            
            <section for="UsersaboutSuper" class="vueport contact section-padding connectssuper" id="section_5"  style="padding-bottom: 10px">
                
            </section>

        </main>
@endsection('content')
