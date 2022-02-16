@include('partials.header')

    <body>
        <div class="flex-center position-ref full-height">
            
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

            <div class="row content">

                <div class="row">
                    <h1 class="col-md-6 float-start">Propiedades</h1>
                    <div class="col-md-6 float-end">
                        <input type="text" id="filter-cost" class="col-md-6 search-box" placeholder="Buscar por precio...">
                    </div>
                </div>

                <div class="row" id="properties-list">
                    <!-- properties list-->
                </div>
                
                <div class="row">
                    <div class="pager" style="display: none">
                        <div class="col-md-6 float-start">
                            <p>Registros por página: <span id="pager_rows"></span></p>
                        </div>
                        <div class="col-md-2 float-end">
                            <span id="pager_from"></span>-<span id="pager_to"></span> de <span id="pager_total"></span>
                            <span id="pager_prev" class="change_page" pag="" style="display: none"><</span>
                            <span id="pager_next" class="change_page" pag="" style="display: none">></span>
                        </div>
                        
                    </div>
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