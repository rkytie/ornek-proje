@extends('front.app')

@section('title', 'Giriş Yap')

@section('style')
    <style>
        .test {
            -webkit-box-shadow: 0px 0px 6px 1px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px 0px 6px 1px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 0px 6px 1px rgba(0, 0, 0, 0.15);
        }

        .shippingInfo {
            margin: 1rem 0 0 0;
            font-weight: 800;
            color: black;
            opacity: 1;
        }

        .shippingInfoSpan {
            margin: 1rem 0 0 0;
            font-weight: 200;
            color: black;
            opacity: 1;
        }
    </style>
@endsection
@section('content')

    <section class="cart-area mb-5">
        <div class="container">
            <div class="breadcrumb">
                <div class="active" style="font-size: 2rem;display: flex;flex-direction: column;align-items: flex-start;">
                    ORDER #{{ $order->id }}
                </div>
            </div>
            <hr>
            <div class="product-list">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <h2>Order Items</h2>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item">
                                            @foreach ($order->order_items as $order_item)
                                                <div class="row align-items-center mt-4">
                                                    <div class="col-md-2"><img src="{{ get_image($order_item->photo) }}"
                                                            class="img-fluid rounded">
                                                    </div>
                                                    <div class="col">
                                                        {{ $order_item->name }}
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($order->order_items_wing as $wing)
                                                <div class="row align-items-center mt-4">
                                                    <div class="col-md-2"><img src="{{ get_image($wing->photo) }}"
                                                            class="img-fluid rounded">
                                                    </div>
                                                    <div class="col">
                                                        {{ $wing->name }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card test">
                                <div class="card-body">
                                    <p class="shippingInfo" style="text-transform:uppercase;font-size:1.6rem;">
                                        @lang('app.siparis_ozeti')
                                    </p>
                                    <p class="shippingInfo">
                                        @lang('app.toplam'):
                                        <span class="shippingInfoSpan">{{ $order->quantity }} x
                                            {{ intval(($order->quantity * $order->orderTotal) / $order->quantity) }}
                                            kr
                                            =
                                            {{ floatval($order->orderTotal * $order->quantity) }} kr</span>
                                    </p>
                                    <p class="shippingInfo">
                                        @lang('app.siparis_tarihi'):
                                        <span
                                            class="shippingInfoSpan">{{ date('d M y H:i', strtotime($order->created_at)) }}</span>
                                    </p>
                                    <hr>
                                    <p class="shippingInfo" style="text-transform:uppercase;font-size:1.6rem;">
                                        @lang('app.teslimat')
                                    </p>
                                    <p class="shippingInfo">
                                        @lang('app.ad'):
                                        <span class="shippingInfoSpan">{{ $order->customerName }}
                                            {{ $order->customerSurname }}</span>
                                    </p>
                                    <p class="shippingInfo">
                                        @lang('app.eposta'):
                                        <span class="shippingInfoSpan">{{ $order->customerEmail }}</span>
                                    </p>

                                    <p class="shippingInfo">
                                        @lang('app.telefon'):
                                        <span class="shippingInfoSpan">{{ $order->customerPhone }}</span>
                                    </p>
                                    <p class="shippingInfo">
                                        @lang('app.adresB'):
                                        <span class="shippingInfoSpan">{{ $order->customerAddress }},
                                            {{ $order->customerCity }}, {{ $order->customerCountry }},
                                            {{ $order->customerZipCode }}</span>
                                    </p>
                                    <hr>
                                    <p class="shippingInfo" style="text-transform:uppercase;font-size:1.6rem;">
                                        @lang('app.odeme_yontemi')
                                    </p>

                                    @if (isset($order->paymentMethod))
                                        <p class="shippingInfo"><strong>Method: </strong>
                                            @if ($order->paymentMethod === 'SVEACARDPAY_PF')
                                                SVEA
                                            @endif
                                        </p>
                                        <div role="alert" class="fade alert alert-success show mt-2 text-center">
                                            @lang('app.odendi')
                                            {{ date('y M h - H:i', strtotime($order->paidAt)) }}
                                        </div>
                                    @else
                                        <div role="alert" class="fade alert alert-danger show mt-2 text-center">
                                            <a href="{{ route('cart') }}"> @lang('app.odenmedi') </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
