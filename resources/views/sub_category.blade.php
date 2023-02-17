@extends('front.app')

@section('title')


{{ $category->name }}


@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.css"
/>
<style media="screen">
  .complete{
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .complete img {
    max-width: 150px;
}

.complete p {
    opacity: 1;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 1rem 0;
}
.sale {
            flex-direction: row-reverse;
        }

        .card {
            width: fit-content;
        }

        .card-body {
            width: fit-content;
        }

        .btn {
            border-radius: 0;
            width: fit-content;
            background-color: #00448e;
            z-index: 1;
            color: white;
            width: 100px;
            font-size: 14px;
            font-weight: 900;
        }

        .img-thumbnail {
            border: none;
        }

        .card {
            box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
            border-radius: 5px;
            padding-bottom: 10px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 900;
        }

        .card-text {
            font-size: 14px;
            font-family: sans-serif;
            font-weight: 500;
        }
</style>

@endsection
@section('content')




<div class="container py-4" style="padding-top: 0.5rem!important; padding-bottom: -0.5rem!important;">
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-1">
      <h1 class="display-6 fw-bold">{{ $category->name }}</h1>
      <div class="row">
        <div class="col-md-8">
          <p class="fs-6">{!! $category->description !!}</p>
        </div>
        @if(get_image($category->title_photo))

        <div class="col-md-4">
          <img class="img-fluid" style="border-radius: 2%;" src="{{ get_image($category->title_photo) }}" alt="">
        </div>
        @else
        @endif
      </div>
    </div>
  </div>
</div>

  <div class="container">
    <div class="row align-items-center">

      @foreach($products->sortBy('ordering') as $product)
          <div class="col-lg-2 col-sm-12 mb-5">
            <a href="{{ route('productView', ['slug' => $product->slug]) }}">

            <div class="card">
                <div class="d-flex sale ">
                    <div class="btn" style="background-color:white"></div>
                </div>
                <img class='mx-auto img-thumbnail'
                    src="@if(isset($product->images()->skip(1-1)->first()->url)) {{ get_image($product->images()->skip(1-1)->first()->url) }} @endif"
                    width="auto" height="auto"/>
                <div class="card-body text-center mx-auto">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <span style="font: menu; color:#00448e">Från {{ $product->price }} kronor</span><br>
                    <button class="btn btn-primary mt-2">@lang('app.incele')</button>
                </div>
            </div>
        </a>

          </div>
      @endforeach
     
      
      
      
      
    </div>
    
    
  </div>

@endsection
