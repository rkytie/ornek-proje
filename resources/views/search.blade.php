@extends('front.app')

@section('title', 'Arama Sonucu')

@section('style')
@endsection


@section('content')



  <div class="container">
    <div class="row">

    @if($datas == NULL)
      <h1>ürün bulunamadı</h1>
    @else

      @foreach($datas as $data)
          <div class="col-lg-4 col-12 mt-5 mb-5">
        <a href="{{ route('productView', ['slug' => $data->slug]) }}">

            <div class="card">

                <img class='mx-auto img-thumbnail'
                    src="@if(isset($data->images()->skip(1-1)->first()->url)) {{ get_image($data->images()->skip(1-1)->first()->url) }} @endif"
                    width="auto" height="auto"/>
                <div class="card-body text-center mx-auto">
                    <h5 class="card-title">{{ $data->name }}</h5>
                    <span style="font: menu; color:#00448e">Från {{ $data->price }} kronor</span><br>
                    <button class="btn btn-primary mt-2">İncele</button>
                </div>
            </div>
        </a>

          </div>
      @endforeach
     
      
      @endif
      
      
    </div>
    
    
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

<script
  type="text/javascript"
  src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
></script>


@endsection
