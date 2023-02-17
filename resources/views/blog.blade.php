
@extends('front.app')

@section('title')

Blog - {{ $blog->title }}

@endsection 
@section('content')

<div class="container-fluid pt-5 pb-5" style="background-color:#98c9ff">
    <div class="row ">
        <div class="col-lg-12 text-center">
            <h4 class="h2" style="font-weight: bold; color:#064890">{{ $blog->title }}</h4>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-lg-12 ">
        {!! $blog->content  !!}

    </div>

</div>



@endsection