@extends('layouts.app')

@section('title') Kanatlar @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Sahip olduğu Kanatlar",
    ])


   @php $a= json_decode($product->defaul_wings,FALSE) @endphp
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.default.wings.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                          <div class="row">
                          @for($i = 1; $i <= $product->wing; $i++)
                                <div class="col-md-12">
                                    <label for="validationCustom04" class="form-label">{{ $i }}. Kanat</label>
                                    <select name="wings[]" class="form-select" id="validationCustom04" required="">
                                    <option selected="" disabled="" value="">Seçiniz...</option>

                                    @foreach($wings as $wing)
                                        <option @if(isset($a)) @if($wing->id == $a[$i -1]) selected @endif @endif value="{{$wing->id}}">{{$wing->name}}</option>
                                    @endforeach

                                    </select>
                                    <div class="invalid-feedback">
                                        Seçiniz
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </section>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" id="update" class="btn btn-success">
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
        $('body').on('click', '#update', function() {
    var wings = $("input[name='wing[]']")
              .map(function(){return $(this).val()}).get();


    $.ajax({
      url: "{{ route('admin.default.wings.store') }}",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        wings:wings,

      },

      success:function(response){
        console.log(response)
    },
      error: function(response) {
        console.log(response)
      },
    });
});
    </script>
@endsection
