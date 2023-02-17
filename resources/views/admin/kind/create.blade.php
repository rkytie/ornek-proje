@extends('layouts.app')

@section('title') Yeni Oda @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Aksesuar Yönetimi",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.kinds.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="accessory_id">Kategori</label>
                                <select name="accessory_id" required class="form-control" id="accessory_id" >
                                    <option value="">Seç</option>
                                    @foreach($accessories as $category)
                                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id ) selected @endif>{{ $category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Bu alanı doldurunuz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Ad</label>
                                <input type="text" class="form-control" id="type" value="{{ old('name') }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="photo">Fotoğraf</label>
                                <input type="file" class="form-control" id="photo" value="{{ old('photo') }}"
                                    name="photo" required>
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
                                <label class="mb-2" for="accessory_id">Hesaplama</label>
                                <select name="calculation" required class="form-control" id="calculation" >
                                    <option value="">Seç</option>
                                    <option value="1" @if (old('category_id') == 1 ) selected @endif>Sabit Fiyat</option>
                                    <option value="2" @if (old('category_id') == 2 ) selected @endif>Alana Göre</option>
                                    <option value="3" @if (old('category_id') == 3 ) selected @endif>Çevreye Göre</option>
                                    <option value="4" @if (old('category_id') == 4 ) selected @endif>Kanat Sayısına Göre</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bu alanı doldurunuz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Hesaplama seçeneğini "Aktif" olarak işaretlediyseniz buraya bir değer girmelisiniz.</label>
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
