@extends('layouts.app')

@section('title') Kanatlar @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Sahip olduğu Kanatlar",
    "pageDescription"=>"Sistemde dairelerin dış özelliklerini belirlemek için alanları doldurun.",
    ])

    {{ $errors }}
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <input type="checkbox" id="checkAll">Hepsini Seç
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.products.wings.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                          <div class="row">
                                @foreach($wings as $wing)
                                    <div class="col-2" style="margin-bottom: 15px;">
                                        <div class="form-check">
                                            <input class="form-check-input" @if($product->wings->contains($wing->id)) checked @endif type="checkbox" value="{{ $wing->id }}" name="wing[]" id="{{ $wing->id }}">
                                            <span><img style="height:150px;" src="{{ get_image($wing->photo) }}" class="img-fluid" alt=""><div><b>{{ $wing->name }}</b></div></span> 
                                            <label class="form-check-label" for="{{ $wing->id }}">
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="mdi mdi-plus mr-2"></i>
                                Güncelle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>

$("#checkAll").click(function(){
$('input:checkbox').not(this).prop('checked', this.checked);
});

</script>

@endsection
