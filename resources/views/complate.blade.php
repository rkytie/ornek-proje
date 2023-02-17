@extends('front.app')

@section('title')

Din beställning är komplett!

@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/complete.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.scss') }}" />

@endsection
@section('content')



    <section class="cart-area">
        <div class="container">
            <div class="product-area">
                <div class="breadcrumb" style="justify-content:center !important">
                    <div class="active" style="font-size: 2rem">@lang('app.siparislerim')</div>
                </div>
                <div class="product-list">
                    <div class="complete">
                        <img src="{{ asset('front/assets/images/complete.png') }}" alt="Complete">
                        <p>Din beställning är komplett!</p>
                        <div class="col-lg-12">
                            <div class="card flex-row"><img class="card-img-left example-card-img-responsive"
                                    src="/postboot/assets/img/thumbnail.jpg" />
                                <div class="card-body">
                                    <h4 class="card-title h5 h4-sm">Left image</h4>
                                    <p class="card-text">Example text</p>
                                </div>
                            </div>
                        </div>




                        {{-- </div>
                <div class="text-center">
                    <button class="btn btn-warning">@lang('app.siparislerim') -></button>
                </div> --}}
                    </div>

                </div>
            </div>
    </section>

@endsection
