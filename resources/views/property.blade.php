@include('partials.header')

    <body>
        <div class="flex-center position-ref full-height">
            <input type="hidden" id="property_name" value="{{$property_name}}">

            <div class="row rectangle-top">
                    <div class="col-md-6 float-start">
                        <a href="/">
                            <img src="/imgs/logo.png" alt="logo">
                            <img src="/imgs/logo_ipsum.png" alt="logo_ipsum">
                        </a>
                    </div>
                    <div class="col-md-6 float-end btn_work">
                        <img src="/imgs/btn_work.png" alt="logo">
                    </div>
                </div>
            </div>

            <div class="row content-detail">

                <div class="row">
                    <h1 class="col-md-9 float-start" id="property-name">{{$property_name}}</h1>
                    <div class="col-md-3 float-end">
                        <h3 id="property-cost"></h3>
                    </div>
                </div>

                <div class="row" id="property-list">
                    <!-- property-detail-->
                </div>

            </div>

            <div class="row rectangle-bottom">

                <div class="slogan">
                    <div class="col-md-6 float-start">
                        <span>Make your dreams a </span><span class="slogan-orange">reality</span>
                    </div>

                    <div class="col-md-6 float-end btn_work">
                        <img src="/imgs/btn_work.png" alt="logo">
                    </div>
                </div>

                <div class="logo">
                    <img src="/imgs/logo.png" alt="logo">
                    <img src="/imgs/logo_ipsum.png" alt="logo_ipsum">                
                </div>

                <div class="social">
                    <a href="#"><img src="/imgs/logo_fb.png" alt="Facebook"></a>
                    <a href="#"><img src="/imgs/logo_twt.png" alt="Twitter"></a>                
                    <a href="#"><img src="/imgs/logo_ig.png" alt="Instagram"></a>                
                </div>

            </div>

        </div>
    </body>

@include('partials.footer')