@extends('layouts.app')

@section('title') Pencereler @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Sahip olduğu Penceler",
    "pageDescription"=>"Sistemde dairelerin dış özelliklerini belirlemek için alanları doldurun.",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                
                <div class="card-body">
                <input type="checkbox" id="checkAll">Hepsini Seç
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.products.window.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                          <div class="row">
                          
                            @foreach($pvcs as $pvc)
                            <div class="col-6" style="margin-bottom: 15px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  @if($data->window->contains($pvc->id)) checked @endif value="{{ $pvc->id }}" name="pvc[]" id="{{ $pvc->id }}">
                                     <span><img style="height:150px;" src="{{ get_image($pvc->photo) }}" class="img-fluid" alt=""><b>{{ $pvc->name }}</b></span> 
                                    <label class="form-check-label" for="{{ $pvc->id }}">
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            </div>
                            
                        </section>
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
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
