@extends('front.app')

@section('title', 'Kontakta oss')
@section('style')
    <style>
        .ftco-section {
            padding: 1em 0;
        }

        .ftco-no-pt {
            padding-top: 0;
        }

        .ftco-no-pb {
            padding-bottom: 0;
        }

        .heading-section {
            font-size: 28px;
            color: #000;
        }

        .img {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            margin-bottom: 2rem;
        }

        textarea.form-control {
            height: inherit !important;
        }

        .wrapper {
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
            -webkit-box-shadow: 0px 21px 41px -13px rgba(0, 0, 0, 0.18);
            -moz-box-shadow: 0px 21px 41px -13px rgba(0, 0, 0, 0.18);
            box-shadow: 0px 21px 41px -13px rgba(0, 0, 0, 0.18);
        }

        .contact-wrap {
            background: #fff;
        }

        .contact-wrap h3 {
            color: #000;
        }

        @media (max-width: 991.98px) {
            .info-wrap {
                height: 400px;
            }
        }

        .social-media h3 {
            font-size: 18px;
        }

        .social-media p a {
            color: rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 500;
            margin-right: 10px;
        }

        .social-media p a:hover {
            color: #000;
        }

        .dbox {
            width: 100%;
            margin-bottom: 25px;
        }

        @media (min-width: 768px) {
            .dbox {
                margin-bottom: 0;
            }
        }

        .dbox p {
            margin-bottom: 0;
        }

        .dbox p span {
            font-weight: 400;
            color: rgba(0, 0, 0, 0.2);
            display: block;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 600;
        }

        .dbox p a {
            color: rgba(0, 0, 0, 0.7);
        }

        .dbox .text {
            width: 100%;
        }

        .btn {
            padding: 12px 16px;
            cursor: pointer;
            border-width: 1px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 400;
            -webkit-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.12);
            -moz-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.12);
            box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.12);
            position: relative;
            margin-bottom: 20px;
            -webkit-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }

        @media (prefers-reduced-motion: reduce) {
            .btn {
                -webkit-transition: none;
                -o-transition: none;
                transition: none;
            }
        }

        .btn:hover,
        .btn:active,
        .btn:focus {
            outline: none !important;
            -webkit-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.22) !important;
            -moz-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.22) !important;
            box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.22) !important;
        }

        .contactForm .form-control {
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 0;
        }

        #contactForm .error {
            color: red;
            font-size: 12px;
        }

        #contactForm .form-control {
            font-size: 16px;
        }

        #message {
            resize: vertical;
        }

        #form-message-warning,
        #form-message-success {
            display: none;
        }

        .form-control:focus {
            border-color: none !important;
            box-shadow: none !important;
        }

        #form-message-warning {
            color: red;
        }

        #form-message-success {
            color: #28a745;
            font-size: 18px;
            font-weight: 500;
        }

        .submitting {
            float: left;
            width: 100%;
            padding: 10px 0;
            display: none;
            font-size: 16px;
            font-weight: 500;
            color: #e3b04b;
        }

        p {
            color: black !important;
            font-size: 0.9rem !important;
        }

        .aText {
            color: black !important;
            font-size: 0.9rem !important;
        }

        .titles {
            color: #064990 !important;
            font-weight: 700 !important;
        }
    </style>
@endsection
@section('content')

    <section class="breadcrumb ">
        <div class="container">
            <a href="https://fonstersida.se">
                <svg width="1em" height="1em" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.5 0.5L7.85355 0.146447C7.65829 -0.0488155 7.34171 -0.0488155 7.14645 0.146447L7.5 0.5ZM1.5 6.5L1.14645 6.14645L1 6.29289V6.5H1.5ZM13.5 6.5H14V6.29289L13.8536 6.14645L13.5 6.5ZM13.8536 6.14645L7.85355 0.146447L7.14645 0.853553L13.1464 6.85355L13.8536 6.14645ZM7.14645 0.146447L1.14645 6.14645L1.85355 6.85355L7.85355 0.853553L7.14645 0.146447ZM14 13.5V6.5H13V13.5H14ZM1 6.5V13.5H2V6.5H1ZM2.5 15H12.5V14H2.5V15ZM13 13.5C13 13.7761 12.7761 14 12.5 14V15C13.3284 15 14 14.3284 14 13.5H13ZM1 13.5C1 14.3284 1.67157 15 2.5 15V14C2.22386 14 2 13.7761 2 13.5H1Z"
                        fill="black"></path>
                </svg>
            </a>
            <a href="https://fonstersida.se">Hem</a>
            <a href="https://fonstersida.se/sub/category/tra-fonsterdorr">Kontakta Oss</a>
        </div>
    </section>

    <section class="ftco-section mb-5">
        <div class="container">
            <div class="row justify-content-md-center">

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
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 style="color:#064990">@lang('app.contactus')</h3>
                                    <p class="mb-4">@lang('app.iletisimAciklama')</p>
                                    <div id="form-message-warning" class="mb-4"></div>
                                    <div id="form-message-success" class="mb-4">
                                        Your message was sent, thank you!
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="dbox w-100 d-flex align-items-start">
                                                <div class="text">
                                                    <p><span class="titles">@lang('app.adresB'):</span> Värmdövägen 104 <br> 13160 <br>Nacka</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dbox w-100 d-flex align-items-start">
                                                <div class="text">
                                                    <p><span class="titles">@lang('app.eposta'):</span> <a class="aText"
                                                            href="mailto:info@fonstersida.com">info@fonstersida.com</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dbox w-100 d-flex align-items-start">
                                                <div class="text">
                                                    <p><span class="titles">@lang('app.telefon'):</span> <a class="aText"
                                                            href="tel://08884942">08884942</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" id="contactForm" name="contactForm" class="contactForm"
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" required
                                                        id="name" placeholder="@lang('app.ad')">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="@lang('app.eposta')">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="phone" required
                                                        id="phone" placeholder="@lang('app.telefon')">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" class="form-control" id="message" required cols="30" rows="4"
                                                        placeholder="@lang('app.createMessage')"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button
                                                        style="color: #fff;
                                                    background-color: #00448e;
                                                    border-color: #00448e;"
                                                        type="button" class="btn btn-primary w-100 btn-submit">
                                                        @lang('app.gonder')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="info-wrap w-100 p-5 img"
                                    style="background-image:url('https://preview.colorlib.com/theme/bootstrap/contact-form-05/images/ximg.jpg.pagespeed.ic.3SzfPzu4gg.webp')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script></script>
    <script>
        $(".btn-submit").click(function(e) {

            e.preventDefault();

            var name = $("#name").val();
            var phone = $("#phone").val();
            var email = $("#email").val();
            var message = $("#message").val();
            $.ajax({
                type: 'POST',
                url: "{{ route('contactPost') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    phone: phone,
                    email: email,
                    message: message,
                },
                success: function(data) {
                    $('#contactForm').trigger("reset");
                    Swal.fire({
                        icon: 'success',
                        title: 'Framgång',
                        text: "Tack! Vi kommer att kontakta dig så snart som möjligt.",
                    })
                },
                error: function(data) {
                    var object = data.responseJSON.errors;
                    $('#errorMessage').text(Object.values(object)[0][0]);
                    Swal.fire({
                        icon: 'error',
                        title: 'Fel',
                        text: Object.values(object)[0][0],
                    })
                }
            });
        });
    </script>





@endsection
