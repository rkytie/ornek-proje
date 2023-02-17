<!DOCTYPE html>
<html lang="tr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta charset="UTF-8" />
    <title>Fönstersida - @yield('title')</title>
    <meta name="author" content="fönstersida" />
    <meta name="owner" content="fönstersida" />
    <meta name="copyright" content="fönstersida 2021" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Fönstersida erbjuder dig ett obegränsat sortiment. Bygg dina drömfönster och dörrsystem själv." />
    <link rel="canonical" href="https://fönstersida.com" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="fönstersida" />
    <meta property="og:url" content="https://fönstersida.com" />
    <meta property="og:site_name" content="fönstersida" />
    <meta property="og:image" content="" />
    <meta property="og:image:secure_url" content="" />
    <link rel="dns-prefetch" href="//fönstersida.com" />
    <link rel="dns-prefetch" href="//s.w.org" />
    <meta httpEquiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{ asset('front/assets/images/favicon.ico') }}" sizes="32x32" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('front/assets/images/favicon.ico') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('front/assets/images/favicon.ico') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <!-- styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />

    @yield('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/slider/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/slider/owl.theme.default.min.css') }}" />
    <link href="{{ asset('assets/css/purecookie.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <style>
        @media only screen and (min-width: 768px) {
            .rootmenu .megamenu::before {
                content: '';
                position: absolute;
                width: 100vw;
                height: 100%;
                left: 50%;
                right: 50%;
                margin-left: -50vw;
                margin-right: -50vw;
                background: linear-gradient(90deg, #fff 0 50%, #7da295 50% 100%);
                box-shadow: 0 2px 5px rgb(0 0 0 / 20%);
            }
        }
    </style>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LV47CLDK9F"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-LV47CLDK9F');
</script>

<body>
    <header>
        <div class="container">

            <a href="/" class="col-md-3  logo-area">
                <img src="{{ asset('front/assets/images/logo.png') }}" alt="Logo" />
            </a>
            <div class="col-md-4 col-lg-4 nav-search">
                <div class="d-flex form-inputs">
                    <form action="{{ route('search') }}" method="GET" ">
              <input
                class="form-control"
                type="text"
                name="search"
                @if (isset($request->search)) value="a"
                @else
                placeholder="@lang('app.ara')" @endif
                style="width: 27rem;"
                
              />
            </form>
            <img src="{{ asset('front/assets/images/search.svg') }}" />
          </div>
        </div>
        
        <div class="col-md-3 right-area">
          <div class="action-area" style="justify-content: space-evenly;">
            <div class="login-area">
              @guest
                                              <a href="{{ route('giris') }}">
                                                <img src="{{ asset('front/assets/images/user.svg') }}" alt="User Icon" />
                                              </a>
              @endguest
              <div class="content-area">
                @guest
                                                <a href="{{ route('giris') }}">@lang('app.giris_yap')</a>
                                                <span>@lang('app.veya')</span>
                                                <a href="{{ route('kayit') }}">@lang('app.kayit_ol')</a>
                @endguest
                @auth
                                                        @if (Auth::user()->permission == 1)
                            <a href="{{ url('/admin') }}">Admin inloggning</a>
                            @endif
                        @endauth
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="favourite-basket">
                    <a href="{{ url('cart') }}" class="basket">
                        <div class="count-area">{{ count((array) session('cart')) }}</div>
                        <img src="{{ asset('front/assets/images/basket.svg') }}" alt="Basket Icon" />
                    </a>
                </div>
            </div>
            @auth
                <div class="favourite-basket">
                    <a href="{{ route('profile') }}" class="basket">
                        <img src="{{ asset('front/assets/images/user.svg') }}" alt="Basket Icon" />
                    </a>
                    <a class="log-out-btn" style="color:#0a58ca" href="#"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"> @lang('app.cikis')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            @endauth
            <div class="mobile-navbar">
                <a class="target-burger">
                    <ul class="buns">
                        <li class="bun"></li>
                        <li class="bun"></li>
                    </ul>
                </a>
                <nav class="main-nav" role="navigation">
                    <ul class="container">
                        @foreach (menuCategories() as $category)
                            <li>
                                <a href="{{ route('categoryView', ['slug' => $category->slug]) }}"
                                    class="dropdown-link"><span>{{ $category->name }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        </div>
        </div>
    </header>

    <main>
        <div class="mobile-search container">
            <div class="d-flex form-inputs">
                <input class="form-control" type="text" placeholder="@lang('app.ara')" />
                <img src="{{ asset('front/assets/images/search.svg') }}" />
            </div>
        </div>
        <div class="navigation" style="background-color:#064890;">
            <nav class="container" style="justify-content: flex-start;">
                @foreach (menuCategories() as $category)
                    <a style=" color:white; margin-right:15px;"
                        href="{{ route('categoryView', ['slug' => $category->slug]) }}">{{ $category->name }}
                        &nbsp;</a>
                @endforeach
            </nav>
        </div>
        @yield('content')




        <div class="container-fluid" style="background-color:#ededed">
            <div class="container">
                <footer class="row py-5 border-top">
                    <div class="col-lg-2 col-6">
                        <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                            <img src="https://fonstersida.se/front/assets/images/logo.png" class="img-fluid"
                                alt="">
                        </a>
                        <p class="text-muted">© 2022</p>
                        <p style="font-size: 0.9rem;">Fönstersida erbjuder dig ett obegränsat sortiment. Bygg dina
                            drömfönster och dörrsystem själv.</p>
                    </div>

                    <div class="col-lg-2 col-6">

                    </div>

                    <div class="col-lg-2 col-6">
                        <h5>Institutionell</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="{{ route('aboutUs') }}"
                                    class="nav-link p-0 text-muted" style="color: #03468f !important;">Om Oss</a></li>
                            <li class="nav-item mb-2"><a href="{{ route('contact') }}"
                                    class="nav-link p-0 text-muted"
                                    style="color: #03468f !important;">Kontakt</a></li>
                            <li class="nav-item mb-2"><a href="{{ route('contact') }}"
                                    class="nav-link p-0 text-muted" style="color: #03468f !important;">Erbjudande</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6">
                        <h5>Innehåll</h5>
                        <ul class="nav flex-column">
                            @foreach (blogs() as $blog)
                                <li class="nav-item mb-2"><a href="{{ route('blogView', ['slug' => $blog->slug]) }}"
                                        class="nav-link p-0 text-muted"
                                        style="color: #03468f !important;">{{ $blog->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6">
                        <h5>Rättslig</h5>
                        <ul class="nav flex-column">
                            @foreach (legals() as $legal)
                                <li class="nav-item mb-2"><a
                                        href="{{ route('legalView', ['slug' => $legal->slug]) }}"
                                        class="nav-link p-0 text-muted"
                                        style="color: #03468f !important;">{{ $legal->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-lg-12 mt-5 text-center align-center">
                        <img style="max-height:150px;" class="img-fluid"
                            src="{{ asset('front/assets/images/bank/visa.png') }}" alt="" />
                    </div>
                </footer>
            </div>


        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('front/assets/js/custom.js') }}"></script>
    <script src="{{ asset('front/assets/js/purecookie.js') }}"></script>
    <script src="{{ asset('front/assets/slider/owl.carousel.min.js') }}"></script>


</body>

</html>
