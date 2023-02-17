@extends('front.app')

@section('title', 'Giriş Yap')

@section('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/cart.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style media="screen">
        .nav-link {
            color: #ffffff !important;
        }

        .nav-pills .nav-link {
            background: #00448e !important;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .card {
            box-shadow: 0 10px 34px -15px rgb(0 0 0 / 24%);
        }
    </style>
@endsection
@section('content')

    <main>
        <div class="mobile-search container">
            <div class="d-flex form-inputs"> <input class="form-control" type="text" placeholder="Search any product...">
                <img src="assets/images/search.svg">
            </div>
        </div>
        <section class="cart-area">
            <div class="container">
                <div class="product-area">
                    <div class="breadcrumb">
                        <div class="left-area">
                            <a href="{{ route('index') }}">
                                <svg width="1em" height="1em" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 0.5L7.85355 0.146447C7.65829 -0.0488155 7.34171 -0.0488155 7.14645 0.146447L7.5 0.5ZM1.5 6.5L1.14645 6.14645L1 6.29289V6.5H1.5ZM13.5 6.5H14V6.29289L13.8536 6.14645L13.5 6.5ZM13.8536 6.14645L7.85355 0.146447L7.14645 0.853553L13.1464 6.85355L13.8536 6.14645ZM7.14645 0.146447L1.14645 6.14645L1.85355 6.85355L7.85355 0.853553L7.14645 0.146447ZM14 13.5V6.5H13V13.5H14ZM1 6.5V13.5H2V6.5H1ZM2.5 15H12.5V14H2.5V15ZM13 13.5C13 13.7761 12.7761 14 12.5 14V15C13.3284 15 14 14.3284 14 13.5H13ZM1 13.5C1 14.3284 1.67157 15 2.5 15V14C2.22386 14 2 13.7761 2 13.5H1Z"
                                        fill="black" />
                                </svg>
                            </a>
                            <div class="active">@lang('app.profiliniz')</div>
                        </div>
                    </div>
                    <div class="product-list">
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
                        @endif

                        <div class="container">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills mb-3 ml-5 mr-5" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation" style="padding-right:5px; padding-bottom:2px;">
                                        @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('confirm_password'))
                                            <button class="nav-link" id="pills-serie-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-serie" type="button" role="tab"
                                                aria-controls="pills-serie" aria-selected="false">@lang('app.profil_bilgileri')</button>
                                        @else
                                            <button class="nav-link active" id="pills-serie-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-serie" type="button" role="tab"
                                                aria-controls="pills-serie" aria-selected="true">@lang('app.profil_bilgileri')</button>
                                        @endif
                                    </li>
                                    <li class="nav-item" role="presentation" style="padding-right:5px; padding-bottom:2px;">
                                        @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('confirm_password'))
                                            <button class="nav-link active" id="pills-glass-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-glass" type="button" role="tab"
                                                aria-controls="pills-glass" aria-selected="true">@lang('app.parola_degistir')</button>
                                        @else
                                            <button class="nav-link" id="pills-glass-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-glass" type="button" role="tab"
                                                aria-controls="pills-glass" aria-selected="false">@lang('app.parola_degistir')</button>
                                        @endif
                                    </li>
                                    <li class="nav-item" role="presentation" style="padding-right:5px; padding-bottom:2px;">
                                        <a href="{{ route('myOrders') }}" class="nav-link" id="pills-utrustningspaket-tab"
                                            type="button" aria-controls="pills-utrustningspaket"
                                            aria-selected="false">@lang('app.siparislerim')</a>
                                    </li>


                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('confirm_password'))
                                        <div class="tab-pane fade" id="pills-serie" role="tabpanel"
                                            aria-labelledby="pills-serie-tab">
                                        @else
                                            <div class="tab-pane fade show active" id="pills-serie" role="tabpanel"
                                                aria-labelledby="pills-serie-tab">
                                    @endif
                                    <div class="row mt-5">

                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="text-center mb-4"><b>@lang('app.profil_bilgileri')</b></h4>

                                                <form action="{{ route('profile.update') }}" method="post"
                                                    class="row g-3 address-form">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <label for="inputFirstName" class="form-label">@lang('app.ad')
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" required name="name"
                                                            value="{{ Auth::user()->name }}" class="form-control">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputFirstName" class="form-label">@lang('app.soyad')
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" required value="{{ Auth::user()->surname }}"
                                                            name="surname" class="form-control">
                                                        @error('surname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputFirstName" class="form-label">@lang('app.eposta')
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="text" required value="{{ Auth::user()->email }}"
                                                            disabled name="email" class="form-control">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputFirstName" class="form-label">@lang('app.dogum_tarihi')
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="date" required
                                                            value="{{ Auth::user()->birthday }}" name="birthday"
                                                            class="form-control">
                                                        @error('birthday')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputFirstName" class="form-label">@lang('app.telefon')
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input type="number" required value="{{ Auth::user()->phone }}"
                                                            name="phone" class="form-control">
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 mt-4 d-flex">
                                                        <button type="submit" class="btn btn-success"
                                                            style="background-color:#064990">
                                                            @lang('app.guncelle')
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <h4><b>@lang('app.adreslerim')</b></h4>
                                        <h4><a href="{{ route('newAdress') }}" class="btn btn-success"
                                                style="background-color:#064990">
                                                @lang('app.yeni_adres_ekle')
                                            </a></h4>

                                        @foreach (Auth::user()->adresses as $adress)
                                            <div class="col-lg-6">

                                                <div class="card mb-3 mt-4">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="card-body d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <h4>{{ $adress->title }}</h4>
                                                                    <h5 class="card-title">{{ $adress->adress }}</h5>
                                                                </div>
                                                                <div>
                                                                    <a class="btn btn-warning"
                                                                        href="{{ route('editAddress', ['id' => $adress->id]) }}">
                                                                        @lang('app.duzenle') </a>
                                                                    <a class="btn btn-danger" href="#"
                                                                        onclick="event.preventDefault();document.getElementById('delete_adress').submit();">
                                                                        @lang('app.sil') </a>
                                                                    <form id="delete_adress"
                                                                        action="{{ route('adressDelete', ['id' => $adress->id]) }}"
                                                                        method="POST" style="display: none;">
                                                                        {{ csrf_field() }}
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('confirm_password'))
                                <div class="tab-pane fade show active" id="pills-glass" role="tabpanel"
                                    aria-labelledby="pills-glass-tab">
                                @else
                                    <div class="tab-pane fade" id="pills-glass" role="tabpanel"
                                        aria-labelledby="pills-glass-tab">
                            @endif
                            <div class="row mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('change.password') }}" method="post"
                                            class="row g-3 address-form">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="inputFirstName" class="form-label">@lang('app.eski_parola')
                                                    <span class="required">*</span>
                                                </label>

                                                <input type="password" required name="current_password"
                                                    class="form-control">
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">@lang('app.yeni_parola')
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="password" required name="new_password" class="form-control">
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label">@lang('app.yeni_parola_onay')
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="password" required name="confirm_password"
                                                    class="form-control">
                                                @error('confirm_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 mt-4 d-flex">
                                                <button type="submit" class="btn btn-primary">
                                                    @lang('app.guncelle')
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-utrustningspaket" role="tabpanel"
                            aria-labelledby="pills-utrustningspaket-tab">

                        </div>



                    </div>
                </div>
            </div>


            </div>
            </div>
            </div>
        </section>
    @endsection
