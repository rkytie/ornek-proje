@extends('layouts.app')

@section('title') PVC'ler @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Sahip olduğu PVC'ler",
    "pageDescription"=>"Sistemde dairelerin dış özelliklerini belirlemek için alanları doldurun.",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.products.pvc.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                          <div class="row">
                          
                            @foreach($pvcs as $pvc)
                            <div class="col-6" style="margin-bottom: 15px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  @if($data->pvc->contains($pvc->id)) checked @endif value="{{ $pvc->id }}" name="pvc[]" id="{{ $pvc->id }}">
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
@endsection
