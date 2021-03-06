<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.elements.head')
</head><!--/head-->

<body>
<!--header-->
    <header id="header">
    <!--header_top-->
        <div class="header_top">
            @include('pages.elements.header-top')
        </div>
    <!--/header_top--> 
    <!--header-middle-->
        <div class="header-middle">
            @include('pages.elements.header-middle')
        </div>
    <!--/header-middle-->
    <!--header-bottom-->
        <div class="header-bottom">
            @include('pages.elements.header-bottom')
        </div>
    <!--/header-bottom-->
    </header>
<!--/header-->
    
    <!--slider-->
    {{-- <section id="slider">
        @include('pages.elements.slider')
    </section> --}}
    <!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        {{-- Tìm kiếm theo giá--}}
                            @include('pages.elements.form-search-price')
                        {{-- end Tìm kiếm theo giá--}}

                        @include('pages.elements.menu-left')
                       <!--  @include('pages.elements.thongke') -->
                        


                    </div>
           
                </div>

                
                <div class="col-sm-9 padding-right">
                    
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        @include('pages.elements.footer')
    </footer>
    <!--/Footer-->
    <!--/jscrip-->
    @include('pages.elements.jscrip')
    

</body>
</html>

