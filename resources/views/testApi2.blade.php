@extends('front.app')

@section('title', 'Giriş Yap')

@section('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/checkout.min.css') }}" />
    <style>
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            display: block;
            color: #064890;
        }
    </style>
@endsection
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-md-center">
            <div class="col-lg-6">
                <div class="card"
                    style="box-shadow:0 10px 34px -15px rgb(0 0 0 / 24%);padding-left:30px; padding-right:30px;padding-top:30px; padding-bottom:30px;">
                    <div class="col-lg-12 text-center mb-3 mt-3">
                        <h3 class="text-center" style="color: #064890;"><b>@lang('app.giris_yap')</b></h3>
                    </div>
                    <div class="col-lg-12">
                        sadgasd
                        {{ $endPointUrl }}

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
