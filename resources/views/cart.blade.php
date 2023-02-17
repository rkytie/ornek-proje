@extends('front.app')

@section('title', 'Sepet')

@section('style')
    <link rel="stylesheet" href="{{ asset('front/assets/css/cart.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <style>
        .produktCard {
            border: none;
        }

        table:hover {
            --bs-table-hover-bg: none
        }
    </style>
@endsection
@section('content')
    <main>
        <section class="cart-area">
            <div class="container">
                <div class="product-area">
                    @if (session('cart') == null)
                        <p style="color: black; font-weight:800" class="text-center">@lang('app.urun_bulunmamaktadir')</p>
                    @else
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
                                <div class="active">@lang('app.sepetiniz')</div>
                            </div>
                            <div class="right-area"> @lang('app.urun_listelendi')</div>
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

                            <table id="cart" class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width:52%">@lang('app.urun')</th>
                                        <th style="width:12%">@lang('app.fiyat')</th>
                                        <th style="width:12%">@lang('app.adet')</th>
                                        <th style="width:12%" class="text-center">@lang('app.toplam')</th>
                                        <th style="width:12%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if (session('cart'))
                                        @foreach ($cart as $id => $details)
                                            @php $total += (floatval($details['price']) * floatval($details['quantity'])) @endphp
                                            <tr>
                                                <td data-th="Product">
                                                    <div class="row">
                                                        {{-- <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}"
                                                            width="100" height="100" class="img-responsive" /></div>
                                                    <div class="col-sm-8">
                                                        <h4>{{ $details['name'] }}<br><br>
                                                            <p style="font-style: oblique;font-size: small;"><b>Height:</b>
                                                                {{ $details['height'] }} cm </p>
                                                            <p style="font-style: oblique;font-size: small;"><b>Width:</b>
                                                                {{ $details['width'] }} cm </p> --}}

                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    <img style="height:100px; margin-left:0.5rem;"
                                                                        class="text-center img-responsive"
                                                                        src="{{ $details['photo'] }}">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Height:</b>
                                                                            {{ $details['height'] }} cm
                                                                        </p>
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Width:</b>
                                                                            {{ $details['width'] }} cm
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <p style="font-style: oblique;font-size: small;"><b>Serie:</b>
                                                                {{ $details['pvc_select'] }} <img style="height:100px;"
                                                                    src="{{ $details['pvc_photo'] }}"> </p> --}}
                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    @if (isset($details['pvc_photo']))
                                                                        <img style="height:100px; margin-left:0.5rem;"
                                                                            class="text-center"
                                                                            src="{{ get_image($details['pvc_photo']) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Serie:</b>
                                                                            {{ $details['pvc_select'] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        {{-- <p style="font-style: oblique;font-size: small;">
                                                                <b>Glassket:</b> {{ $details['window_select'] }}
                                                            </p> --}}
                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    @if (isset($details['window_photo']))
                                                                        <img style="height:100px; margin-left:0.5rem;"
                                                                            src="{{ get_image($details['window_photo']) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Glassket:</b>
                                                                            {{ $details['window_select'] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <p style="font-style: oblique;font-size: small;"><b>Hantag:</b>
                                                                {{ $details['handle_select'] }} <img style="height:100px;"
                                                                    src="{{ $details['handle_photo'] }}"> </p> --}}
                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    @if (isset($details['handle_photo']))
                                                                        <img style="height:100px; margin-left:0.5rem;"
                                                                            src="{{ get_image($details['handle_photo']) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Hantag:</b>
                                                                            {{ $details['handle_select'] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <p style="font-style: oblique;font-size: small;"><b>Glas: </b>
                                                                {{ $details['glass_select'] }} <img style="height:100px;"
                                                                    src="{{ $details['glass_photo'] }}"></p> --}}
                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    @if (isset($details['glass_photo']))
                                                                        <img style="height:100px; margin-left:0.5rem;"
                                                                            src="{{ get_image($details['glass_photo']) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Glas:</b>
                                                                            @if (!empty($details['glass_select']))
                                                                                {{ $details['glass_select'] }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <p style="font-style: oblique;font-size: small;"><b>Kulör:</b>
                                                                {{ $details['color_select'] }} <img style="height:100px;"
                                                                    src="{{ $details['color_photo'] }}"> </p> --}}
                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    @if (isset($details['color_photo']))
                                                                        <img style="height:100px; margin-left:0.5rem;"
                                                                            src="{{ get_image($details['color_photo']) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Kulör:</b>
                                                                            {{ $details['color_select'] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($details['wings'] as $key => $item)
                                                            <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                                <div class="row no-gutters">
                                                                    <div class="col-md-4 d-flex align-items-center">
                                                                        @if (isset($details['photo']))
                                                                            <img style="height:100px; margin-left:0.5rem;"
                                                                                src="{{ get_image($item['photo']) }}">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="card-body">
                                                                            <p
                                                                                style="font-style: oblique;font-size: small;">
                                                                                <b>@lang('app.kanat') -
                                                                                    {{ $key + 1 }}:</b>
                                                                                {{ $details['name'] }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        {{-- <p style="font-style: oblique;font-size: small;"><b>Spröjs &
                                                                    Mittpost:</b> {{ $details['slat_select'] }} <img
                                                                    style="height:100px;"
                                                                    src="{{ $details['slat_photo'] }}"> </p> --}}
                                                        <div class="card mb-3 produktCard" style="max-width: 540px;">
                                                            <div class="row no-gutters">
                                                                <div class="col-md-4 d-flex align-items-center">
                                                                    @if (isset($details['slat_photo']))
                                                                        <img style="height:100px; margin-left:0.5rem;"
                                                                            src="{{ get_image($details['slat_photo']) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">
                                                                        <p style="font-style: oblique;font-size: small;">
                                                                            <b>Spröjs &
                                                                                Mittpost:</b>
                                                                            @if (!empty($details['slat_select']))
                                                                                {{ $details['slat_select'] }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-th="Price">{{ $details['price'] }} kr</td>
                                                <td data-th="Quantity">
                                                    <input type="number" value="{{ $details['quantity'] }}"
                                                        class="form-control quantity" />
                                                </td>
                                                <td data-th="Subtotal" class="text-center">
                                                    {{ intval($details['price']) * intval($details['quantity']) }} kr</td>
                                                <td class="actions" data-th="">
                                                    <button class="btn btn-info btn-sm update-cart"
                                                        data-id="{{ $id }}"><i
                                                            class="fa fa-refresh"></i></button>
                                                    <button class="btn btn-danger btn-sm remove-from-cart"
                                                        data-id="{{ $id }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>

                            <div class="bottom-info">
                                <div class="info-item">
                                    <div class="img-area">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"
                                            style="enable-background: new 0 0 60 60" xml:space="preserve">
                                            <path
                                                d="m59.7 30.3-8-9c-.1-.2-.4-.3-.7-.3h-7V8c0-.6-.4-1-1-1H20v2h22v28H19v2h23v4H22v2h21c.6 0 1-.4 1-1V23h6.6l6.2 7H50v2h8v12h2V31c0-.3-.1-.5-.3-.7zM14 41c-3.3 0-6 2.7-6 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z">
                                            </path>
                                            <path
                                                d="M51 41c-3.3 0-6 2.7-6 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zM50 35h3v2h-3z">
                                            </path>
                                            <circle cx="14" cy="47" r="2"></circle>
                                            <circle cx="51" cy="47" r="2"></circle>
                                            <path
                                                d="M0 43h6v2H0zM0 7h17v2H0zM3 15h19v2H3zM11 23h19v2H11zM0 32h14v2H0zM4 23h4v2H4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="content">
                                        <div class="title">@lang('app.tahmini_teslimat')</div>
                                        <div class="date">05/09/2022</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="summary">
                    <div class="content">
                        <div class="title">@lang('app.siparis_ozeti')</div>
                        @if (isset($errorAddress))
                            <div class="alert alert-danger" role="alert">
                                {{ $errorAddress }}
                            </div>
                        @endif
                        <div class="summary-info">
                            <div class="item">
                                <div class="left"> @lang('app.urun')</div>
                            </div>
                        </div>
                        <div class="total">
                            <div class="left">@lang('app.toplam')</div>
                            <div class="right">
                                <div class="now"> {{ floatval($total) }} kr</div>
                            </div>
                        </div>

                        <a href="@if (!Auth::check()) {{ route('guestCartAddress') }}@else{{ route('cartAddress') }} @endif"
                            class="btn w-100 py-3 next " style="background-color: #00b328; color: white;margin-top:3px;">
                            @lang('app.odeme')</a>

                        <a href="/" style="background-color: #00448e; color: white;margin-top:3px;"
                            class="btn w-100 py-3 resume">@lang('app.alisverise_devam_et')</a>
                        @if (!Auth::check())
                            <div class="text-center mt-3">
                                <a href="{{ route('guestCartAddress') }}">
                                    @lang('app.uyeliksiz_devam_et') <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <script type="text/javascript">
            $(".update-cart").click(function(e) {
                e.preventDefault();
                var ele = $(this);
                $.ajax({
                    url: '{{ url('update-cart') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val()
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

            $(".remove-from-cart").click(function(e) {
                e.preventDefault();
                var ele = $(this);
                swal({
                    title: "Är du säker?",
                    text: "Artiklar och anpassningar i din kundvagn kommer att raderas!",
                    icon: "warning",
                    buttons: [
                        'Ge upp',
                        'Radera'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '{{ url('remove-from-cart') }}',
                            method: "DELETE",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: ele.attr("data-id")
                            },
                            success: function(response) {
                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Inställt", "Transaktionen avbröts", "error");
                    }
                })


            });
        </script>



    @endsection
