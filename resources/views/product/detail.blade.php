@extends('front.app')

@section('title', 'Anasayfa')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('front/assets/css/product-detail.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.css" />

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .nav-link {
            color: #ffffff !important;
        }

        .nav-pills .nav-link {
            background: #00448e !important;
        }


        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #00448e !important;
        }


        .selected_tab {
            background-color: #011a37 !important;
        }

        #ads {
            margin: 30px 0 30px 0;

        }

        #ads .card-notify-badge {
            position: absolute;
            left: -10px;
            top: -20px;
            background: #f2d900;
            text-align: center;
            border-radius: 30px 30px 30px 30px;
            color: #000;
            padding: 5px 10px;
            font-size: 14px;

        }

        #ads .card-notify-year {
            position: absolute;
            right: -10px;
            top: -20px;
            background: #ff4444;
            border-radius: 50%;
            text-align: center;
            color: #fff;
            font-size: 14px;
            width: 50px;
            height: 50px;
            padding: 15px 0 0 0;
        }


        #ads .card-detail-badge {
            background: #165498;
            ;
            text-align: center;
            border-radius: 20px 10px 20px 10px;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
        }



        #ads .card:hover {
            background: #fff;
            box-shadow: 3px 3px 5px 0px rgba(46, 61, 73, 0.15);
            transition: all 0.3s ease;
        }

        #ads .card-image-overlay {
            font-size: 20px;
        }

        .main-product-detail .container .slider-area .slider-nav {
            margin: 0px 0px 0;
        }


        #ads .card-image-overlay span {
            display: inline-block;
        }


        #ads .ad-btn {
            text-transform: uppercase;
            width: 150px;
            height: 40px;
            border-radius: 80px;
            font-size: 16px;
            line-height: 35px;
            text-align: center;
            border: 3px solid #e6de08;
            display: block;
            text-decoration: none;
            margin: 20px auto 1px auto;
            color: #000;
            overflow: hidden;
            position: relative;
            background-color: #e6de08;
        }

        #ads .ad-btn:hover {
            background-color: #e6de08;
            color: #1e1717;
            border: 2px solid #e6de08;
            background: transparent;
            transition: all 0.3s ease;
            box-shadow: 3px 3px 4px 0px rgba(46, 61, 73, 0.15);
        }

        #ads .ad-title h5 {
            text-transform: uppercase;
            font-size: 18px;
        }

        .selected-ac {
            align-items: center;
            border: groove;
            border-color: #1659a0;
            border-style: inset;
            border-width: 3px;
            border-radius: 3px;
        }

        .fbdiv {
            position: fixed;
            height: 100px;
            bottom: 0;
            width: 100%;
            background-color: #004b9d;
            z-index: 9999;
        }
    </style>
@endsection
@section('content')

    <section class="breadcrumb">
        <div class="container">
            <a href="{{ route('index') }}">
                <svg width="1em" height="1em" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.5 0.5L7.85355 0.146447C7.65829 -0.0488155 7.34171 -0.0488155 7.14645 0.146447L7.5 0.5ZM1.5 6.5L1.14645 6.14645L1 6.29289V6.5H1.5ZM13.5 6.5H14V6.29289L13.8536 6.14645L13.5 6.5ZM13.8536 6.14645L7.85355 0.146447L7.14645 0.853553L13.1464 6.85355L13.8536 6.14645ZM7.14645 0.146447L1.14645 6.14645L1.85355 6.85355L7.85355 0.853553L7.14645 0.146447ZM14 13.5V6.5H13V13.5H14ZM1 6.5V13.5H2V6.5H1ZM2.5 15H12.5V14H2.5V15ZM13 13.5C13 13.7761 12.7761 14 12.5 14V15C13.3284 15 14 14.3284 14 13.5H13ZM1 13.5C1 14.3284 1.67157 15 2.5 15V14C2.22386 14 2 13.7761 2 13.5H1Z"
                        fill="black" />
                </svg>
            </a>
            <a href="{{ route('index') }}">@lang('app.anasayfa')</a>
            <a
                href="{{ route('subCategoryView', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
        </div>
    </section>
    <section class="main-product-detail">
        <div class="container">
            <div class="row">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        @if (is_array(session('success')))
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                            </ul>
                        @else
                            {{ session('success') }}
                        @endif
                    </div>
                @elseif(session()->has('warning'))
                    <div class="alert alert-warning">
                        @if (is_array(session('warning')))
                            @foreach (session('warning') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                            </ul>
                        @else
                            {{ session('warning') }}
                        @endif
                    </div>
                @endif
                <div class="col-lg-6 position-relative slider-area">
                    <div class="slider-for">
                        @foreach ($product->images as $images)
                            <a href="{{ get_image($images->url) }}" class="slide image-popup-vertical-fit"
                                data-lightbox="product" data-title="">
                                <img src="{{ get_image($images->url) }}" alt="" />
                            </a>
                        @endforeach
                    </div>
                    <div class="slider-nav mt-1">
                        @foreach ($product->images as $images)
                            <div class="slide">
                                <img src="{{ get_image($images->url) }}" alt="" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 info-area">
                    <h1 class="fs-3 fw-bolder">
                        {{ $product->name }}
                    </h1>
                    <div class="d-flex align-items-center mt-1">
                        <div class="stars">
                            <svg class="active" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                            </svg>
                            <svg class="active" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                            </svg>
                            <svg class="active" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                            </svg>
                            <svg class="active" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                            </svg>
                            <svg class="active" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                            </svg>
                        </div>
                    </div>
                    @if (empty($product->price))

                        @if (isset($product->defaul_wings))
                            @php  $a = json_decode($product->defaul_wings,FALSE) @endphp
                        @endif

                        <form id="SubmitForm" action="{{ route('addCart') }}" method="POST" class="mt-2">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 style="color:#00448e">@lang('app.genislik')</h5>
                                    <div class="d-flex form-inputs">
                                        <input id="width" type="range" class="form-range"
                                            min="{{ $product->min_width }}" max="{{ $product->max_width }}"
                                            value="{{ $product->min_width }}">
                                    </div>
                                    <h6>(Min : {{ $product->min_width }} cm / Max : {{ $product->max_width }} cm)</h6>
                                </div>
                                <div class="col-lg-6">
                                    <h5 style="color:#00448e">@lang('app.yukseklik')</h5>
                                    <div class="d-flex form-inputs">
                                        <input id="height" type="range" class="form-range"
                                            min="{{ $product->min_height }}" max="{{ $product->max_height }}"
                                            value="{{ $product->min_height }}" />
                                    </div>
                                    <h6>(Min : {{ $product->min_height }} cm / Max : {{ $product->max_height }} cm)</h6>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex form-inputs">
                                        <input id="width-input" class="form-control" name="width"
                                            value="{{ $product->min_width }}" type="number"
                                            min="{{ $product->min_width }}" max="{{ $product->max_width }}"
                                            placeholder="cm" name="genislik" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex form-inputs">
                                        <input class="form-control" id="height-input" name="height" type="number"
                                            value="{{ $product->min_height }}" min="{{ $product->min_height }}"
                                            max="{{ $product->max_height }}" name="yukseklik" placeholder="cm"
                                            required />
                                    </div>
                                </div>
                                @if (empty($product->price))
                                    <input type="hidden" name="product_id" value="{{ $product->id }}"
                                        id="product-id">
                                    <input type="hidden" name="pvc_id" id="pvc-id"
                                        value="{{ $product->pvc_default->id }}">
                                    <input type="hidden" name="window_id" id="window-id"
                                        value="{{ $product->window_default->id }}">
                                    <input type="hidden" name="color_id" id="color-id"
                                        value="{{ $product->color_default->id }}">
                                    <input type="hidden" name="handle_id" id="handle-id"
                                        value="{{ $product->handle_default->id }}">
                                    <input type="hidden" name="slat_id" id="slat-id"
                                        value="{{ $product->slat_default->id }}">
                                    @for ($i = 1; $i <= $product->wing; $i++)
                                        <input type="hidden" name="wing[]" id="wing-id{{ $i }}"
                                            value="{{ $a[$i - 1] }}">
                                    @endfor

                                    @if (isset($product->glass_feature_default))
                                        <input type="hidden" name="glass_feature_id" id="glass-feature-id"
                                            value="{{ $product->glass_feature_default->id }}">
                                    @else
                                        <input type="hidden" id="glass-feature-id" value="">
                                    @endif
                                @endif
                            </div>
                        </form>
                    @endif

                    <div class="col-lg-12 mt-2">
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="col-lg-12">
                                <div class="row">
                                    <h4 class="fw-bold fs-4">@lang('app.fiyat'): <span class="fw-bold fs-4"
                                            id="price">
                                            @if (isset($product->price))
                                                {{ $product->price }}
                                            @else
                                                {{ productPriceCal($product->min_height, $product->min_width, $product->id) }}
                                            @endif
                                        </span> kr</h4>
                                </div>
                            </div>
                        </div>
                        <a id="sepete-ekle" style="background-color: var(--auxiliary); color: var(--white);}"
                            class="btn w-100 py-3 basket-button">
                            @lang('app.sepete_ekle')
                        </a>
                        @if (empty($product->price))
                            <div class="mt-2  ">
                                <a href="#section-accss" style="background-color:#00448e; color: var(--white);}"
                                    class="btn w-100 py-3 basket-button">
                                    @lang('app.ozellestir')
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            @if (isset($product->price))
            @else
                <div id="section-accss">
                    <div class="col-lg-12 justify-content-center pt-5">
                        <div class="accordion " id="accordionExample">
                            <div class="accordion-item" id="pvc-acordion">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsepvc" aria-expanded="true" aria-controls="collapsepvc">
                                        @lang('app.pvc')
                                    </button>
                                </h2>
                                <div id="collapsepvc" class="accordion-collapse collapse show"
                                    aria-labelledby="headingpvc" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="owl-carousel owl-theme">
                                                    @foreach ($pvcs as $pvc)
                                                        @if ($product->pvc->contains($pvc->id))
                                                            <div class="col-lg-4 text-center "
                                                                data-id="{{ $pvc->id }}" id="pvc-select"
                                                                style="width:100%" id="ads">
                                                                <div class="card rounded d-flex  pvcs pt-3 @if ($product->pvc_id == $pvc->id) selected-ac @endif"
                                                                    id="pvc-card-{{ $pvc->id }}"
                                                                    style="align-items:center">
                                                                    <div class="card-image ">
                                                                        <img class="img-fluid"
                                                                            style="width: 150px; height: 150px;"
                                                                            src="{{ get_image($pvc->photo) }}"
                                                                            alt="Fonstersida {{ $pvc->name }}" />
                                                                    </div>
                                                                    <div class="card-image-overlay m-auto mt-2">
                                                                        <span
                                                                            class="card-detail-badge">{{ $pvc->name }}</span>
                                                                        <div class="row">
                                                                            <span class="mt-2"
                                                                                style="font-size: x-small;">{!! $pvc->content !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center">
                                                                        <a class="btn btn-dark"
                                                                            data-id="{{ $pvc->id }}" id="pvc-select"
                                                                            href="javascript:void(0);" href="#">
                                                                            +

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item" id="window-acordion">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button id="btn-window" class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsewindow" aria-expanded="false"
                                        aria-controls="collapsewindow">
                                        @lang('app.window')
                                    </button>
                                </h2>
                                <div id="collapsewindow" class="accordion-collapse collapse "
                                    aria-labelledby="headingwindow" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="owl-carousel owl-theme" id="car2">
                                                    @foreach ($windows as $window)
                                                        @if ($product->window->contains($window->id))
                                                            <div class="col-lg-4 text-center"
                                                                data-id="{{ $window->id }}" id="window-select"
                                                                style="width:100%" id="ads">
                                                                <div class="card rounded windows pt-3 @if ($product->window_id == $window->id) selected-ac @endif"
                                                                    id="window-card-{{ $window->id }}"
                                                                    style="align-items:center">
                                                                    <div class="card-image ">
                                                                        <img class="img-fluid"
                                                                            style="width: 150px; height: 150px;"
                                                                            src="{{ get_image($window->photo) }}"
                                                                            alt="Fonstersida {{ $window->name }}" />
                                                                    </div>
                                                                    <div class="card-image-overlay m-auto mt-2">
                                                                        <span
                                                                            class="card-detail-badge">{{ $window->name }}</span>
                                                                        <div class="row">
                                                                            <span class="mt-2"
                                                                                style="font-size: x-small;">{!! $window->content !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center">
                                                                        <a class="btn btn-dark"
                                                                            data-id="{{ $window->id }}"
                                                                            id="window-select" href="javascript:void(0);">
                                                                            +
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item" id="handle-acordion">
                                <h2 class="accordion-header" id="headingThree">
                                    <button id="btn-handle" class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsehandle" aria-expanded="false"
                                        aria-controls="collapsehandle">
                                        @lang('app.handle')
                                    </button>
                                </h2>
                                <div id="collapsehandle" class="accordion-collapse collapse"
                                    aria-labelledby="headinghandle" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="owl-carousel owl-theme" id="car2">
                                                    @foreach ($handles as $handle)
                                                        @if ($product->handle->contains($handle->id))
                                                            <div class="col-lg-4 text-center"
                                                                data-id="{{ $handle->id }}" id="handle-select"
                                                                style="width:100%" id="ads">
                                                                <div class="card rounded handle pt-3 @if ($product->handle_id == $handle->id) selected-ac @endif"
                                                                    id="handle-card-{{ $handle->id }}"
                                                                    style="align-items:center">
                                                                    <div class="card-image ">
                                                                        <img class="img-fluid"
                                                                            style="width: 150px; height: 150px;"
                                                                            src="{{ get_image($handle->photo) }}"
                                                                            alt="Fonstersida {{ $handle->name }}" />
                                                                    </div>
                                                                    <div class="card-image-overlay m-auto mt-2">
                                                                        <span
                                                                            class="card-detail-badge">{{ $handle->name }}</span>
                                                                        <div class="row">
                                                                            <span class="mt-2"
                                                                                style="font-size: x-small;">{!! $handle->content !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center">
                                                                        <a class="btn btn-dark"
                                                                            data-id="{{ $handle->id }}"
                                                                            id="handle-select" href="javascript:void(0);">
                                                                            +
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item" id="glass-acordion">
                                <h2 class="accordion-header" id="headingFive">
                                    <button id="btn-glass_feature" class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseglass_feature"
                                        aria-expanded="true" aria-controls="collapseglass_feature">
                                        @lang('app.glass_feature')
                                    </button>
                                </h2>
                                <div id="collapseglass_feature" class="accordion-collapse collapse "
                                    aria-labelledby="headingglass_feature" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="owl-carousel owl-theme" id="car2">
                                                    @foreach ($glass_features as $glass_feature)
                                                        @if ($product->glass_feature->contains($glass_feature->id))
                                                            <div class="col-lg-4 text-center"
                                                                data-id="{{ $glass_feature->id }}"
                                                                id="glass_feature-select" style="width:100%"
                                                                id="ads">
                                                                <div class="card rounded glass_feature pt-3 @if ($product->glass_feature_id == $glass_feature->id) selected-ac @endif"
                                                                    id="glass_feature-card-{{ $glass_feature->id }}"
                                                                    style="align-items:center">
                                                                    <div class="card-image ">
                                                                        <img class="img-fluid"
                                                                            style="width: 150px; height: 150px;"
                                                                            src="{{ get_image($glass_feature->photo) }}"
                                                                            alt="Fonstersida {{ $glass_feature->name }}" />
                                                                    </div>
                                                                    <div class="card-image-overlay m-auto mt-2">
                                                                        <span
                                                                            class="card-detail-badge">{{ $glass_feature->name }}</span>
                                                                        <div class="row">
                                                                            <span class="mt-2"
                                                                                style="font-size: x-small;">{!! $glass_feature->content !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center">
                                                                        <a class="btn btn-dark"
                                                                            data-id="{{ $glass_feature->id }}"
                                                                            id="glass_feature-select"
                                                                            href="javascript:void(0);">
                                                                            +
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item" id="color-acordion">
                                <h2 class="accordion-header" id="headingFour">
                                    <button id="btn-color" class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsecolor" aria-expanded="true"
                                        aria-controls="collapsecolor">
                                        @lang('app.color')
                                    </button>
                                </h2>
                                <div id="collapsecolor" class="accordion-collapse collapse "
                                    aria-labelledby="headingcolor" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="owl-carousel owl-theme" id="car2">
                                                    @foreach ($colors as $color)
                                                        @if ($product->color->contains($color->id))
                                                            <div class="col-lg-4 text-center"
                                                                data-id="{{ $color->id }}" id="color-select"
                                                                style="width:100%" id="ads">
                                                                <div class="card rounded color pt-3 @if ($product->color_id == $color->id) selected-ac @endif"
                                                                    id="color-card-{{ $color->id }}"
                                                                    style="align-items:center">
                                                                    <div class="card-image ">
                                                                        @if (isset($color->photo))
                                                                            <img style="border: outset;width: 150px; height: 150px;"
                                                                                src="{{ get_image($color->photo) }} ">
                                                                        @else
                                                                            <div
                                                                                style="border: outset;width: 150px; height: 150px; background-color: {{ $color->rgb }}">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="card-image-overlay m-auto mt-2">
                                                                        <span
                                                                            class="card-detail-badge">{{ $color->name }}</span>
                                                                        <div class="row">
                                                                            <span class="mt-2"
                                                                                style="font-size: x-small;">{!! $color->content !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center">
                                                                        <a class="btn btn-dark"
                                                                            data-id="{{ $color->id }}"
                                                                            id="color-select" href="javascript:void(0);">
                                                                            +
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @for ($i = 1; $i <= $product->wing; $i++)
                                <div class="accordion-item" id="wing{$i}-acordion">
                                    <h2 class="accordion-header" id="headingFour-{{ $i }}">
                                        <button id="btn-wing{{ $i }}" class="accordion-button collapsed"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsewing{{ $i }}" aria-expanded="true"
                                            aria-controls="collapsewing{{ $i }}">
                                            @lang('app.kanat') - {{ $i }}
                                        </button>
                                    </h2>
                                    <div id="collapsewing{{ $i }}" class="accordion-collapse collapse "
                                        aria-labelledby="headingwing{{ $i }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="owl-carousel owl-theme" id="car2">
                                                        @foreach ($wings as $wing)
                                                            @if ($product->wings->contains($wing->id))
                                                                <div class="col-lg-3 text-center"
                                                                    data-id="{{ $wing->id }}"
                                                                    id="wing{{ $i }}-select"
                                                                    style="width:100%" id="ads">
                                                                    <div class="card rounded wing{{ $i }} pt-3 @if ($wing->id == $a[$i - 1]) selected-ac @endif"
                                                                        id="wing{{ $i }}-card-{{ $wing->id }}"
                                                                        style="align-items:center">
                                                                        <div class="card-image">
                                                                            <img class="img-fluid" style="height:160px"
                                                                                src="{{ get_image($wing->photo) }}"
                                                                                alt="Fonstersida Fönster {{ $wing->name }}" />
                                                                        </div>
                                                                        <div class="card-image-overlay m-auto mt-2">
                                                                            <span
                                                                                class="card-detail-badge">{{ $wing->name }}
                                                                            </span>
                                                                            <div class="row">
                                                                                <span class="mt-2"
                                                                                    style="font-size: x-small;">{!! $wing->content !!}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body text-center">
                                                                            <a class="btn btn-dark"
                                                                                data-id="{{ $wing->id }}"
                                                                                id="wing-select"
                                                                                href="javascript:void(0);">
                                                                                +
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor


                            <div class="accordion-item" id="slat-acordion">
                                <h2 class="accordion-header" id="headingFour">
                                    <button id="btn-slat" class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseslat" aria-expanded="true"
                                        aria-controls="collapseslat">
                                        @lang('app.slat')
                                    </button>
                                </h2>
                                <div id="collapseslat" class="accordion-collapse collapse " aria-labelledby="headingslat"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="owl-carousel owl-theme" id="car2">
                                                    @foreach ($slats as $slat)
                                                        @if ($product->slat->contains($slat->id))
                                                            <div class="col-lg-4 text-center "
                                                                data-id="{{ $slat->id }}" id="slat-select"
                                                                style="width:100%" id="ads">
                                                                <div class="card rounded d-flex  slat pt-3 @if ($product->slat_id == $slat->id) selected-ac @endif"
                                                                    id="slat-card-{{ $slat->id }}"
                                                                    style="align-items:center">
                                                                    <div class="card-image ">
                                                                        <img class="img-fluid"
                                                                            style="width: 150px; height: 150px;"
                                                                            src="{{ get_image($slat->photo) }}"
                                                                            alt="Fonstersida {{ $slat->name }}" />
                                                                    </div>
                                                                    <div class="card-image-overlay m-auto mt-2">
                                                                        <span
                                                                            class="card-detail-badge">{{ $slat->name }}</span>
                                                                        <div class="row">
                                                                            <span class="mt-2"
                                                                                style="font-size: x-small;">{!! $slat->content !!}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body text-center">
                                                                        <a class="btn btn-dark"
                                                                            data-id="{{ $slat->id }}"
                                                                            id="slat-select" href="javascript:void(0);"
                                                                            href="#">
                                                                            +

                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>


    <section class="product-summary">
        <div class="container">
            <h6 class="fs-5 fw-bolder mb-4">@lang('app.urunun_aciklamasi')</h6>
            <p>
                {!! $product->description !!}
            </p>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        $('body').on('click', '#sepete-ekle', function() {

            $('#SubmitForm').submit();
        });
    </script>
    <script>
        @for ($i = 1; $i <= $product->wing; $i++)
            $('body').on('click', '#wing{{ $i }}-select', function() {
                var id = $(this).data("id");
                $(".wing{{ $i }}").removeClass("selected-ac");
                $("#wing{{ $i }}-card-" + id).toggleClass("selected-ac");
                $('#wing-id{{ $i }}').val(id);
                let width = $('#width-input').val();
                let height = $('#height-input').val();
                let product_id = $('#product-id').val();
                let window_id = $('#window-id').val();
                let pvc_id = $('#pvc-id').val();
                let handle_id = $('#handle-id').val();
                let color_id = $('#color-id').val();
                let glass_feature_id = $('#glass-feature-id').val();
                @for ($y = 1; $y <= $product->wing; $y++)
                    let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
                @endfor
                var wings = $("input[name='wing[]']")
                    .map(function() {
                        return $(this).val()
                    }).get();
                $.ajax({
                    url: "{{ route('calculate') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        width: width,
                        height: height,
                        product_id: product_id,
                        pvc_id: pvc_id,
                        window_id: window_id,
                        handle_id: handle_id,
                        color_id: color_id,
                        glass_feature_id: glass_feature_id,
                        wings: wings,
                    },
                    success: function(response) {
                        @if ($i != $product->wing)
                            $('#price').text(response);
                            $('#sepet-fiyat').val(response);
                            $("#btn-wing{{ $i + 1 }}").click();
                        @else

                            $("#btn-slat").click();
                        @endif

                    },
                    error: function(response) {
                        console.log(response)
                    },
                });
            });
        @endfor

        $('body').on('click', '#slat-select', function() {
            var id = $(this).data("id");
            $(".slat").removeClass("selected-ac");
            $("#slat-card-" + id).toggleClass("selected-ac");
            $('#slat-id').val(id);
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let slat_id = $('#slat-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();


            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,
                    slat: slat_id,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);
                    $(document).ready(function() {
                        $(window).scrollTop(0);
                    });

                },
                error: function(response) {
                    console.log(response)
                },
            });
        });

        $('body').on('click', '#handle-select', function() {
            var id = $(this).data("id");
            $(".handle").removeClass("selected-ac");
            $("#handle-card-" + id).toggleClass("selected-ac");
            $('#handle-id').val(id);
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();


            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);
                    $("#btn-glass_feature").click();
                },
                error: function(response) {
                    console.log(response)
                },
            });
        });





        $('body').on('click', '#color-select', function() {
            var id = $(this).data("id");
            $(".color").removeClass("selected-ac");
            $("#color-card-" + id).toggleClass("selected-ac");
            $('#color-id').val(id);
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();

            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);
                    $("#btn-wing1").click();


                },
                error: function(response) {
                    console.log(response)
                },
            });
        });



        $('body').on('click', '#glass_feature-select', function() {
            var id = $(this).data("id");
            $(".glass_feature").removeClass("selected-ac");
            $("#glass_feature-card-" + id).toggleClass("selected-ac");
            $('#glass-feature-id').val(id);
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();


            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);

                    $("#btn-color").click();

                },
                error: function(response) {
                    console.log(response)
                },
            });
        });

        $('body').on('click', '#window-select', function() {
            var id = $(this).data("id");
            $(".windows").removeClass("selected-ac");
            $("#window-card-" + id).toggleClass("selected-ac");
            $('#window-id').val(id);
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();


            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);

                    $("#btn-handle").click();

                },
                error: function(response) {
                    $('#price').text(response);
                    $("#btn-handle").click();
                },
            });
        });

        $('body').on('click', '#pvc-select', function() {
            var id = $(this).data("id");
            $(".pvcs").removeClass("selected-ac");
            $("#pvc-card-" + id).toggleClass("selected-ac");
            $('#pvc-id').val(id);
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();


            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);

                    $("#btn-window").click();

                },
                error: function(response) {
                    console.log(response);
                },
            });

        });
    </script>
    <script>
        $(document).on('input change', '#width', function(e) {
            $('#price').html('<i class="fas fa-spinner fa-spin"> </i>').delay(2000).fadeIn();

            $('#width-input').val($(this).val());
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();

            e.preventDefault();

            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },

                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);


                },
                error: function(response) {
                    $('#messageErrorMsg').text(response.responseJSON.errors.message);
                },
            });

        });

        $(document).on('input change', '#height', function(e) {
            $('#price').html('<i class="fas fa-spinner fa-spin"> </i>').fadeIn('slow');

            $('#height-input').val($(this).val());
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();

            e.preventDefault();

            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);


                },
                error: function(response) {
                    console.log(response)

                },
            });
        });

        $(document).on('input change', '#width-input', function(e) {
            $('#price').html('<i class="fas fa-spinner fa-spin"> </i>').fadeIn('slow');

            $('#width').val($(this).val());
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();

            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();

            e.preventDefault();

            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);
                    $('#sepet-fiyat').val(response);


                },
                error: function(response) {
                    console.log(response)
                },
            });
        });

        $(document).on('input change', '#height-input', function(e) {
            $('#price').html('<i class="fas fa-spinner fa-spin"> </i>').fadeIn('slow');

            $('#height').val($(this).val());
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();

            e.preventDefault();

            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);


                },
                error: function(response) {
                    console.log(response)
                },
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#price').html('<i class="fas fa-spinner fa-spin"> </i>').fadeIn('slow');

            $('#height').val($(this).val());
            let width = $('#width-input').val();
            let height = $('#height-input').val();
            let product_id = $('#product-id').val();
            let window_id = $('#window-id').val();
            let pvc_id = $('#pvc-id').val();
            let handle_id = $('#handle-id').val();
            let color_id = $('#color-id').val();
            let glass_feature_id = $('#glass-feature-id').val();
            @for ($y = 1; $y <= $product->wing; $y++)
                let wing_id_{{ $y }} = $('#wing-id{{ $y }}').val();
            @endfor

            var wings = $("input[name='wing[]']")
                .map(function() {
                    return $(this).val()
                }).get();


            $.ajax({
                url: "{{ route('calculate') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    width: width,
                    height: height,
                    product_id: product_id,
                    pvc_id: pvc_id,
                    window_id: window_id,
                    handle_id: handle_id,
                    color_id: color_id,
                    glass_feature_id: glass_feature_id,
                    wings: wings,

                },
                success: function(response) {
                    $('#price').text(response);


                },
                error: function(response) {
                    console.log(response)
                },
            });
        });
    </script>

    </script>
    <script src="{{ asset('front/assets/slider/owl.carousel.min.js') }}"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 7
                }
            }
        })
    </script>

    <script>
        $('#car2').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 7
                }
            }
        })
    </script>

    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "PAGE-ID");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'API-VERSION'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>



@endsection
