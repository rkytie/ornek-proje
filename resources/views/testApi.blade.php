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

                <div class="col-lg-12">
                    <form id="paymentForm" method="post" action="{{ $view['htmlFormAction'] }}">
                        <input type="hidden" name="merchantid" value="{{ $view['merchantid'] }}">
                        <input type="hidden" name="mac" value="{{ $view['mac'] }}">
                        <input type="hidden" name="message" value="{{ $view['message'] }}">
                        <button class="btn btn-success" type="submit">@lang('app.gonder') </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('form#myForm').submit();
        });
    </script>


@endsection
