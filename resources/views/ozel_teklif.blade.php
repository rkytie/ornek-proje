@extends('front.app')

@section('title', 'Giriş Yap')

@section('style')
<link rel="stylesheet" href="{{ asset('front/assets/css/checkout.min.css') }}" />

<style>
  .invalid-feedback {
    display: block !important;
    width: 100%;
    margin-top: 0.25rem;
    font-size: .875em;
    color: #dc3545;
}

.form-label{
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
    <div class="col-lg-6 ">
      <div class="card" style="box-shadow:0 10px 34px -15px rgb(0 0 0 / 24%);padding-left:30px; padding-right:30px;padding-top:30px; padding-bottom:30px;">
        <div class="col-lg-12 mb-3 mt-3">
          <h3 class="text-center" style="color: #064890;"><b>@lang('app.hesap_olustur')</b></h3>
          <p class="text-center" style="    font-size: 0.9rem;
    opacity: 1;
    margin: 0rem 0;
    color: #064890;">Anmäl dig nu och missa inte chansen!</p>
        </div>
        <div class="col-lg-12">
          
          <form action="{{ route('register') }}" method="POST" id="registerForm" class="row g-3 address-form">
            @csrf
            <div class="col-md-6">
              <label for="inputFirstName" class="form-label" style="font-size: 14px;
    font-weight: 600;
    display: block;">@lang('app.ad')
                <span class="required">*</span>
              </label>
              <input type="text" required  name="name" value="{{ old('name') }}" class="form-control">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="inputFirstName" class="form-label" style="font-size: 14px;
    font-weight: 600;
    display: block;">@lang('app.soyad')
                <span class="required">*</span>
              </label>
              <input type="text" required value="{{ old('surname') }}"name="surname" class="form-control">
              @error('surname')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="inputFirstName" class="form-label" style="font-size: 14px;
    font-weight: 600;
    display: block;" style="font-size: 14px;
    font-weight: 600;
    display: block;">@lang('app.eposta')
                <span class="required">*</span>
              </label>
              <input type="email" required  value="{{ old('email') }}" name="email" class="form-control">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="phone" class="form-label" style="font-size: 14px;
    font-weight: 600;
    display: block;" style="font-size: 14px;
    font-weight: 600;
    display: block;">@lang('app.telefon_numarasi')
                <span class="required">*</span>
              </label>
              <input type="number" id="phone" required  value="{{ old('phone') }}" name="phone" class="form-control">
              @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-md-12">
              <label for="password_confirmation" class="form-label" style="font-size: 14px;
    font-weight: 600;
    display: block;" style="font-size: 14px;
    font-weight: 600;
    display: block;">@lang('app.parola_tekrari') <span class="required">*</span></label>
              <textarea type="password" required  name="password_confirmation" class="form-control" id="inputPasswordConfirm"></textarea>
              @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-12 d-flex">
              <button type="submit" style="    color: #fff;
    background-color: #00448e;
    border-color: #00448e;" class="btn btn-primary">
              Skicka
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>







@endsection
