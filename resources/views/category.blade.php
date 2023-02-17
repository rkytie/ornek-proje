@extends('front.app')

@section('title')


{{ $category->name }}


@endsection


@section('content')


  <div class="container pt-5 align-items-center">
  <div class="row">
            <div class="col-lg-12 text-center" style="margin-bottom:5px;">
                <h4><b style="color:#064890">@lang('app.urun_kategorileri')</b></h4>
            </div>
        </div>
    <div class="row">
      
    @foreach($categories as $category)
    <div class="col-lg-4 col-sm-4 col-4">

    <div class="product-item">
      <a href="{{ route('subCategoryView', ['slug' => $category->slug]) }}">
      <div class="img-area">
        <img src="{{ get_image($category->photo) }}" alt="Product" />
      </div>
    </a>
      <div class="product-name"><a href="{{ route('subCategoryView', ['slug' => $category->slug]) }}">{{ $category->name }}</a></div>
    </div>
    </div>

    @endforeach
    </div>

  </div>

@endsection
