@extends('front.app')

@section('title', 'Yeni Adres')

@section('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/checkout.min.css') }}" />

@endsection
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-md-center">
            <div class="col-lg-6">
                <div class="card"
                    style="box-shadow:0 10px 34px -15px rgb(0 0 0 / 24%);padding-left:30px; padding-right:30px;padding-top:30px; padding-bottom:30px;">
                    <div class="col-lg-12 text-center mb-3 mt-3">
                        <h3 class="text-center" style="color: #064890;"><b>@lang('app.yeni_adres')</b></h3>
                    </div>
                    <div class="col-lg-12">
                        <form action="{{ route('guestCartAddressPost') }}" method="post" class="row g-3 address-form">
                            @csrf
                            <span><b>@lang('app.teslim_alacak_kisinin')</b></span>
                            <div class="col-md-6">
                                <label for="inputFirstName" class="form-label">@lang('app.ad')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" required name="name" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="inputFirstName" class="form-label">@lang('app.soyad')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" required name="surname" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label for="inputFirstName" class="form-label">@lang('app.eposta')
                                    <span class="required">*</span>
                                </label>
                                <input type="email" required name="email" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label for="inputFirstName" class="form-label">@lang('app.telefon')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" required name="phone" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label for="inputFirstName" class="form-label">@lang('app.adres')
                                    <span class="required">*</span>
                                </label>
                                <textarea type="text" required name="adress" class="form-control"></textarea>
                            </div>

                            <div class="col-md-4">
                                <label for="inputFirstName" class="form-label">@lang('app.sehir')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" required name="city" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label for="inputFirstName" class="form-label">@lang('app.ulke')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" required name="country" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label for="inputFirstName" class="form-label">@lang('app.postakodu')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" required name="zipCode" class="form-control">
                            </div>

                            <div class="col-12 mt-4 d-flex">
                                <button type="submit" class="btn btn-success">
                                    @lang('app.kaydet')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
