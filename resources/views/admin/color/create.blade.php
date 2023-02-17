@extends('layouts.app')

@section('title') Renk Ekle @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Renk Ekle",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.colors.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                            
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Ad</label>
                                <input type="text" class="form-control" id="type" value="{{ old('name') }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">RGB Kodu</label>
                                <input type="color" class="form-control" id="type" value="{{ old('rgb') }}"
                                    placeholder="Ad" name="rgb" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="photo">Fotoğraf</label>
                                <input type="file" class="form-control" id="photo" value="{{ old('photo') }}"
                                    name="photo" >
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="content">İçerik</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control"  id="content" value="{{ old('content') }}" name="content"></textarea>
                                </div>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir içerik giriniz.
                                </div>
                            </div>
                           
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Birim Fiyat</label>
                                <input type="text" class="form-control" id="type" value="{{ old('price') }}" name="price" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
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
