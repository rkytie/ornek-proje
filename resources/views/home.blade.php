@extends('front.app')

@section('title')


@lang('app.anasayfa')

@endsection


@section('content')

    <link rel="stylesheet" href="{{ asset('front/assets/slider/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/slider/owl.theme.default.min.css') }}" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>


    <style media="screen">
        .owl-dots .owl-dot.active {
            background-color: #69728c;
            outline: 0;
            display: none;
        }


        @media screen and (max-width: 850px) {
            .advantage-bar .advantage-item {
                margin-top: 1rem;
            }
        }

        .advantage-bar .advantage-item+.advantage-item {
            border-left: 1px solid var(--border);
        }

        @media screen and (max-width: 850px) {
            .advantage-bar .advantage-item+.advantage-item {
                border: none;
            }
        }

        .advantage-bar .advantage-item svg {
            width: 45px;
            fill: var(--primary);
            stroke: var(--primary);
            margin-right: 12px;
        }

        .advantage-bar .advantage-item h6 {
            font-size: 1rem;
            font-weight: 700;
            width: 40%;
        }

        @media screen and (max-width: 850px) {
            .advantage-bar .advantage-item h6 {
                width: 80%;
            }
        }

        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
        }

        .counter-bl {
            width: 140px;
            height: 140px;
            line-height: 100px;
            font-family: 'Ubuntu', 'sans-serif';
            background-image: linear-gradient(to right, #3dd0d8 0%, rgb(228 0 255 / 64%) 100%);
            border-radius: 50%;
            text-align: center;
            font-size: 48px;
            font-weight: 700;
            color: #fff;
            margin-right: 2rem;
        }

        .counter-content .counter-title {
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'Ubuntu', 'sans-serif';
            color: #064990;
        }

        .counter-round {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin: 2rem;
        }

        .right-reverse {
            flex-direction: row-reverse;
            margin-left: 0rem;
            margin-right: 4rem !important;
        }

        .productName {
            color: white;
            background-color: #064990c7 !important;
            padding: 0 0.4rem !important;
            border-radius: 0.2rem;
            font-size: 1.4rem;
        }
    </style>




    <section class="hero-slider mb-5">

        @foreach ($sliders as $slider)
            <div class="slider-item">
                <img src="{{ get_image($slider->photo) }}" style="background-size: cover;object-fit: cover;"
                    alt="Slider Item" />
            </div>
        @endforeach
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" style="margin-bottom:5px;">
                <h3><b style="color:#064890">@lang('app.urun_kategorileri')</b></h3>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel owl-theme ">
                @foreach (menuCategories() as $category)
                    <a href="{{ route('categoryView', ['slug' => $category->slug]) }}">
                        <div class="item" style="background-color: rgb(300, 300, 300);">
                            <img src="{{ get_image($category->title_photo) }}" alt="Categories" style="border-radius: 2%;"
                                class="img-fluid" />
                            <div class="bottom-right productName">
                                {{ $category->name }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <div class="container pt-5">
    <div class="row">
            <div class="col-lg-12 text-center" style="margin-bottom:5px;">
                <h3><b style="color:#064890">@lang('app.kampanyalar')</b></h3>
            </div>
        </div>
        <div class="row">
            @foreach ($campaigns as $campaign)
                <div class="col-lg-4">
                    <a class="item" href="{{ $campaign->link }}">
                        <img src="{{ get_image($campaign->photo) }}" alt="{{ $campaign->name }}" class="img-fluid" /
                            style="padding-bottom: 45px; ">
                    </a>
                </div>
            @endforeach
        </div>
       
    </div>


    

    <div class="container pt-5 mb-3">
        <div class="row">
            <div class="col-lg-12 text-center" style="margin-bottom:5px;">
                <h3><b>@lang('app.materyaller')</b></h3>
            </div>
        </div>
        <div class="row">
            @foreach ($discounts as $discount)
                <div class="col-lg-4">
                    <a href="{{ $discount->link }}"><img src="{{ get_image($discount->photo) }}" alt="Fönstersida"
                            class="img-fluid" /></a>
                </div>
            @endforeach
        </div>
    </div>






    <script src="{{ asset('front/assets/slider/owl.carousel.min.js') }}"></script>
    <script>
        $("#owl-slider").owlCarousel({
            items: 1,
            nav: false,
            dots: true,
            loop: true,
            autoplay: false,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1
                }
            }
        });
    </script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 5,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>


@endsection
