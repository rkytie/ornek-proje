@extends('layouts.app')

@section('title') Düzenle @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Kategori Düzenle",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.categories.update', $category->id) }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="name">Ad</label>
                                <input type="text" class="form-control" id="name" value="{{ $category->name  }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Üst Kategori <br> (Eklediğiniz bir alt kategori değilse boş bırakın)</label>
                                    <div class="col-lg-9">
                                      <select name="category_id" class="form-select">

                                        @foreach($categories as $categoryy)
                                          <option @if($categoryy->id == $category->category_id) selected @endif value="{{ $categoryy->id }}">{{ $categoryy->name }}</option>
                                        @endforeach
                                        <option value="">Üst Kategori</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="photo">Fotoğraf 200x200 (Eğer güncellemek istemiyorsanız boş bırakın)</label>
                                <input type="file" class="form-control" id="photo"
                                    name="photo" >
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="photo">Başlık Fotoğrafı</label>
                                <input type="file" class="form-control" id="title_photo" value="{{ old('title_photo') }}"
                                    name="title_photo" >
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="ordering">Sıra</label>
                                <input type="text" class="form-control" id="ordering" value="{{ $category->ordering }}"
                                    placeholder="Sıra" name="ordering" >
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir sıra giriniz.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Açıklama</label>
                                    <div class="col-lg-9">
                                        <textarea name="description" rows="8" cols="80">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-plus mr-2"></i>
                                Düzenle
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
    <!-- end row -->

@endsection
