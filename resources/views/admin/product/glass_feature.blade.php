@extends('layouts.app')

@section('title') Pencere Özellikleri @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Sahip olduğu Kulplar",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.products.glass_feature.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                          <div class="row">
                          
                            @foreach($glass_features as $glass_feature)
                            <div class="col-6" style="margin-bottom: 15px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  @if($data->glass_feature->contains($glass_feature->id)) checked @endif value="{{ $glass_feature->id }}" name="glass_feature[]" id="{{ $glass_feature->id }}">
                                     <span><img style="height:150px;" src="{{ get_image($glass_feature->photo) }}" class="img-fluid" alt=""><b>{{ $glass_feature->name }}</b></span> 
                                    <label class="form-check-label" for="{{ $glass_feature->id }}">
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
