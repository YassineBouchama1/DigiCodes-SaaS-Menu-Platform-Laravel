@if($isBlocked)
    <h1>is blocked</h1>
@else
    @if(empty($Categories))
        <h1>is not empty</h1>
    @endif
@endif

@if(!$isBlocked && !empty($Categories))
<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
</head>
{{-- @dd($Categories) --}}
<body class="body-fixed">
<div id="viewport">
    <div id="js-scroll-content">
        <section style="background-image: url(assets/images/menu-bg.png);"
            class="our-menu section bg-light repeat-img" id="menu">
            <div class="sec-wp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sec-title text-center mb-5">
                                <h3 class="sec-sub-title mb-3">our menu</h3>
                                <h2 class="h2-title">wake up early, <span>eat fresh & healthy</span></h2>
                                <div class="sec-title-shape mb-4">
                                    <img src="assets/images/title-shape.svg" alt="">
                                </div>
                            </div>
                            @if($restaurant->opening_hour &&$restaurant->closing_hour)
                            <div class="col-lg-6 ">
                                <div class="footer-flex-box">
                                    <div class="footer-table-info">
                                        <h3 class="h3-title">open hours</h3>
                                        <ul>
                                            <li><i class="uil uil-clock"></i>From {{$restaurant->opening_hour}} To {{$restaurant->closing_hour}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="menu-tab-wp">
                        <div class="row">
                            <div class="col-lg-12 m-auto">
                                <div class="menu-tab text-center">
                                    <ul class="filters">
                                        <div class="filter-active"></div>
                                        <li class="filter" data-filter=".all @foreach($Categories as $category), .{{ $category->title }}@endforeach">
                                            <img src="assets/images/menu-1.png" alt="">
                                            All
                                        </li>
                                        @foreach ($Categories as $Categorie)
                                        <li class="filter" data-filter=".{{$Categorie->title}}">
                                            {{$Categorie->title}}
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-list-row">
                        <div class="row g-xxl-5 bydefault_show" id="menu-dish">
                            @foreach ($menuItems as $menuItem)
                            <div class="col-lg-4 col-sm-6 dish-box-wp {{$menuItem->menu->title}}" data-cat="{{$menuItem->menu->title}}">
                                <div class="dish-box text-center">
                                    <div class="dist-img">
                                        <img src="{{ asset('images').'/'.$menuItem->media[0]->url }}" alt="">
                                    </div>
                                    <div class="dish-title">
                                        <h3 class="h3-title">{{$menuItem->title}}</h3>
                                        <p>{{$menuItem->price}} dh</p>
                                    </div>
                                    <div class="dish-info">
                                        <ul>
                                            <li>
                                                <p>Description</p>
                                                <b class="text-right">{{$menuItem->description}}</b>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer starts  -->
        <footer class="site-footer" id="contact">
            <div class="top-footer section">
                <div class="sec-wp">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="footer-info">
                                    <div class="footer-logo">
                                        <a href="index.html">
                                            <img src="logo.png" alt="">
                                        </a>
                                    </div>
                                    {{-- <h2>{{$restaurant->name}}</h2>
                                    <p>{{$restaurant->address}}
                                    </p> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </footer>



    </div>
</div>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('js/gsap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
@endif
