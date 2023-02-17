@extends('front.app')


@section('title')


@lang('app.adres')

@endsection

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

        .sca:hover {
            cursor: pointer;
        }

        .cardBorder {

            border: 1px solid black;
        }

        .selectAddress {
            cursor: pointer;
        }

        .firstDivAddress {
            display: flex;
            flex-direction: row;
            align-items: baseline;

        }

        .secondDivAddress {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }
    </style>
@endsection
@section('content')

    <main>
        <section class="cart-area">
            <div class="container">
                <div class="product-area">
                    <div class="breadcrumb" style="justify-content:center !important">
                        <div class="active" style="font-size: 2rem">@lang('app.teslimat_adresi')</div>
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
                        @if (Auth::check())
                            <h4 class="mt-3">
                                <a href="{{ route('newAdress') }}" class="btn btn-success" style="background-color:#064990">
                                    @lang('app.yeni_adres_ekle')
                                </a>
                            </h4>
                        @endif
                        <div class="row justify-content-between">
                            @if (Auth::check())
                                @if (Auth::user()->adresses->count() < 1)
                                    <div class="col-lg-8">
                                        <div class="alert alert-danger" role="alert">
                                            {{ $errorAddress }}
                                        </div>
                                        <h4 class="mt-3">
                                            <a href="{{ route('newAdress') }}" class="btn btn-success"
                                                style="background-color:#064990">
                                                @lang('app.yeni_adres_ekle')
                                            </a>
                                        </h4>
                                    </div>
                                @else
                                    <div class="col-lg-8">
                                        <div class="row">
                                            @foreach (Auth::user()->adresses as $adress)
                                                <div class="col-lg-12 ">
                                                    <div class="card mb-3 mt-4">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-12">
                                                                <div class="card-body d-flex justify-content-between sca selectAddress_{{ $adress->id }}"
                                                                    onclick="submitAddress({{ $adress->id }})">
                                                                    <div>
                                                                        <div class="firstDivAddress">
                                                                            <i class="fa-solid fa-user"></i>
                                                                            <h4 style="margin-left:1rem;">
                                                                                {{ $adress->name }}
                                                                                {{ $adress->surname }}</h4>
                                                                        </div>

                                                                        <div class="secondDivAddress">
                                                                            <h5 class="card-title">
                                                                                {{ $adress->adress }}
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <input type="hidden" data-id=""
                                                                            id="addressValue">
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
                                @endif
                            @else
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <div class="card mb-3 mt-4">
                                                <div class="row no-gutters">
                                                    <div class="col-md-12">
                                                        <div
                                                            class="card-body d-flex justify-content-between sca cardBorder">
                                                            <div>
                                                                @foreach (session('shippingAddress') as $value)
                                                                    <div class="firstDivAddress">
                                                                        <i class="fa-solid fa-user"></i>
                                                                        <h4 style="margin-left:1rem;">
                                                                            {{ $value[0]['name'] }}
                                                                            {{ $value[0]['surname'] }}</h4>
                                                                    </div>

                                                                    <div class="secondDivAddress">
                                                                        <h5 class="card-title">
                                                                            {{ $value[0]['adress'] }}
                                                                        </h5>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @endif
                            <div class="col-lg-4">
                                <div class="summary col-lg-12" style="margin-top:0rem;padding:0rem 0 0 0.8rem;">
                                    <div class="content">
                                        <div class="title">@lang('app.siparis_ozeti')</div>
                                        <div class="d-flex">
                                            <input type="checkbox" id="checkContract" name="checkContract"
                                                style="transform:scale(1.5)">
                                            <a href="https://fonstersida.se/legal/kopvillkor" target="_blank" for="vehicle1"
                                                style="margin:1rem 0 1rem 3.5rem">
                                                @lang('app.sozlesmeyi_onayliyorum')</a><br>
                                        </div>
                                        <div class="total">
                                            <div class="left">@lang('app.toplam')</div>
                                            <div class="right">
                                                <div class="now"> {{ $total }} kr</div>
                                            </div>
                                        </div>
                                        <button class="btn w-100 py-3 next odeme" type="button"
                                            style="background-color: #00b328; color: white;margin-top:3px;">
                                            @lang('app.odeme')</button>

                                        <a href="/" style="background-color: #00448e; color: white;margin-top:3px;"
                                            class="btn w-100 py-3 resume">@lang('app.alisverise_devam_et')</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <form id="paymentForm" method="post" action="">
                        @csrf
                        <input type="hidden" name='merchantid' value="" id="merchantid">
                        <input type="hidden" name='message' value="" id="message">
                        <input type="hidden" name='mac' value="" id="mac">
                    </form>


                </div>
            </div>
            <div class="tab-pane fade" id="pills-utrustningspaket" role="tabpanel"
                aria-labelledby="pills-utrustningspaket-tab">
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(".odeme").click(function(e) {
            e.preventDefault();
            if ($('.sca').hasClass("cardBorder") && $('#checkContract:checked').length > 0) {
                var addressValue = $('#addressValue').data('id'); //getter
                var submitText = $(this).text()
                $(this).html(
                    '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...'
                ).attr('disabled', true);
                $.ajax({
                    url: "{{ route('cartAddressPost') }}",
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        addressValue: addressValue
                    },
                    success: function(response) {
                        $.ajax({
                            url: "{{ route('testApi') }}",
                            method: "get",
                            success: function(response) {
                                $('#paymentForm').attr('action', response.htmlFormAction);
                                $('#merchantid').val(response.merchantid);
                                $('#mac').val(response.mac);
                                $('#message').val(response.message);
                                $('#paymentForm').submit();
                                $(".odeme").prop("disabled", false);
                                $(".spinner-border").remove();
                                $(".odeme").text(submitText);
                            },
                            error: function(error) {
                                $(".odeme").prop("disabled", false);
                                $(".spinner-border").remove();
                                $(".odeme").text(submitText);
                            }
                        });
                    },
                    error: function(error) {
                        $(".odeme").prop("disabled", false);
                        $(".spinner-border").remove();
                        $(".odeme").text(submitText);
                    }
                });
            } else {
                swal({
                    text: "Vänligen fyll i de obligatoriska fälten för att göra en betalning.",
                    icon: "warning",
                })
            }
        });

        function submitAddress(id) {
            $('.sca').removeClass("cardBorder");
            $('.selectAddress_' + id).toggleClass('cardBorder');
            $('#addressValue').data('id', id); //setter
        }
    </script>
@endsection
