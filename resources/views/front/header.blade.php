<!DOCTYPE html>
<html lang="tr">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta charset="UTF-8" />
    <title>Fönstersida</title>
    <meta name="author" content="fönstersida" />
    <meta name="owner" content="fönstersida" />
    <meta name="copyright" content="fönstersida 2021" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="fönstersida" />
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- styles -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    />
    
    @yield('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/slider/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/slider/owl.theme.default.min.css') }}" />

    <link
      rel="stylesheet"
      type="text/css"
      href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />

    <style>
      @media only screen and (min-width: 768px){
.rootmenu .megamenu::before{
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
}}

    </style>
  </head>
  <body>
    <header>
      <div class="container">
        
        <div class="col-md-4 col-lg-4 nav-search">
          <div class="d-flex form-inputs">
            <form action="{{ route('search')}}" method="GET" ">
              <input
                class="form-control"
                type="text"
                name="search"
                @if(empty($request->search))
                  placeholder="@lang('app.ara')"
                @else
                  value="<?=$_GET['search']?>"
                @endif
                style="width: 27rem;"
                
              />
            </form>
            <img src="{{ asset('front/assets/images/search.svg')}}" />
          </div>
        </div>
        <a href="/" class="col-md-4 logo-area">
          <img src="{{ asset('front/assets/images/logo.png')}}" alt="Logo" />
        </a>
        <div class="col-md-3 right-area">
          <div class="action-area" style="justify-content: space-evenly;">
            <div class="login-area">
              @guest
              <a href="{{ route('giris') }}">
                <img src="{{ asset('front/assets/images/user.svg')}}" alt="User Icon" />
              </a>
              @endguest
              <div class="content-area">
                @guest
                <a href="{{ route('giris') }}">@lang('app.giris_yap')</a>
                <span>@lang('app.veya')</span>
                <a href="{{ route('kayit') }}">@lang('app.kayit_ol')</a>
                @endguest
                @auth
                @if(Auth::user()->permission == 1)
                <a href="{{ url('/admin') }}">Admin inloggning</a>
                @endif
                @endauth
              </div>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <div class="favourite-basket">
                <a href="{{ url('cart') }}" class="basket">
                  <div class="count-area">{{ count((array) session('cart')) }}</div>
                  <img src="{{ asset('front/assets/images/basket.svg')}}" alt="Basket Icon" />
                </a>
              </div>
            </div>
            @auth
            <div class="favourite-basket">
              <a href="{{ route('profile') }}" class="basket">
                <img src="{{ asset('front/assets/images/user.svg')}}" alt="Basket Icon" />
              </a>
              <a class="log-out-btn" style="color:#0a58ca" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> @lang('app.cikis') </a>
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
                  @foreach(menuCategories() as $category)
                  <li>
                    <a href="{{ route('categoryView', ['slug' => $category->slug]) }}" class="dropdown-link"><span>{{ $category->name }}</span></a>
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
          <input
            class="form-control"
            type="text"
            placeholder="@lang('app.ara')"
          />
          <img src="{{ asset('front/assets/images/search.svg')}}" />
        </div>
      </div>
      <div class="navigation" style="background-color:#064890;">
        <nav class="container" style="justify-content: flex-start;">
          @foreach(menuCategories() as $category)
            <a style=" color:white; margin-right:15px;" href="{{ route('categoryView', ['slug' => $category->slug]) }}">{{ $category->name }} &nbsp;</a>
          @endforeach
        </nav>
      </div>