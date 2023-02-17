@extends('layouts.app')

@section('title') Kulp Ekle @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Kulp Ekle",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.handles.update', ['handle' => $handle->id]) }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section>
                            
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Ad</label>
                                <input type="text" class="form-control" id="type" value="{{ $handle->name }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="photo">Fotoğraf</label>
                                <input type="file" class="form-control" id="photo" value=""
                                    name="photo">
                                    <img src="" alt="">
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="content">İçerik</label>
                                <div class="form-group">
                                    <textarea class="ckeditor form-control"  id="content" value="" name="content">{{ $handle->content }}</textarea>
                                </div>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir içerik giriniz.
                                </div>
                            </div>
                           
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Birim Fiyat</label>
                                <input type="text" class="form-control" id="type" value="{{ $handle->price }}" name="price" required>
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
