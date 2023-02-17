@extends('layouts.app')

@section('title') Yeni Kanat @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Kanat ekle",
    ])
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.products.wings.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="name">Yükseklik</label>
                                    <input type="text" class="form-control" id="height" value="{{ old('height') }}"
                                        placeholder="" name="height" required>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir isim giriniz.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="name">Genişlik</label>
                                    <input type="text" class="form-control" id="width" value="{{ old('width') }}"
                                        placeholder="" name="width" required>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir isim giriniz.
                                    </div>
                                </div>
                            </div>
                           
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                        </section>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-plus mr-2"></i>
                                Ekle
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
    <!-- end row -->

@endsection
