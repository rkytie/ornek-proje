@extends('front.app')

@section('title', 'Giriş Yap')

@section('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/complete.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.scss') }}" />
    <style>
        .orderCardP {
            font-size: small;
            opacity: 1;
            font-weight: 700;
            margin-top: -1rem;
        }
    </style>
@endsection
@section('content')



    <section class="cart-area">
        <div class="container">
            <div class="product-area">
                <div class="breadcrumb" style="justify-content:center !important">
                    <div class="active" style="font-size: 2rem">@lang('app.siparislerim')</div>
                </div>
                <div class="product-list">
                    @if (session()->has('success'))
                        <div class="complete">
                            <img src="{{ asset('front/assets/images/complete.png') }}" alt="Complete">
                            <p>Din beställning är komplett!</p>
                        </div>
                        </ul>
                    @elseif(session()->has('error'))
                        <div class="alert alert-warning">
                            @foreach (session('warning') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($orders as $order)
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mt-4">
                                    <div class="row">
                                        <div class="card-deck">
                                            <div class="card flex-row" style="align-items: center !important;">
                                                @if (isset($order->order_items[0]->photo))
                                                    <img class="card-img-left example-card-img-responsive"
                                                        style="margin: 1rem; width:120px; height:120px;"
                                                        src="{{ get_image($order->order_items[0]->photo) }}" />
                                                @endif
                                                <div class="card-body">
                                                    <div>
                                                        <p style="font-size: small;opacity:1;font-weight:700">
                                                            {{ date('d M y', strtotime($order->created_at)) }}
                                                        </p>
                                                        <p class="orderCardP">
                                                            {{ $order->order_items[0]->name }}
                                                        </p>
                                                        <p class="orderCardP">
                                                            @lang('app.toplam'): <span
                                                                style="font-weight:500">{{ $order->orderTotal * $order->quantity }}
                                                                kr</span>
                                                        </p>
                                                    </div>
                                                    <a href="{{ route('orderDetail', ['id' => $order->id]) }}"
                                                        class="orderCardP"
                                                        style="text-decoration: underline;color:#064990;">
                                                        @lang('app.siparis_detaylari') ->
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- </div>
                <div class="text-center">
                    <button class="btn btn-warning">@lang('app.siparislerim') -></button>
                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection
