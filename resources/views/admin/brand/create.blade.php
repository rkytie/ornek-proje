@extends('layouts.app')

@section('title') Yeni Marka @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Marka Ekle",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.brands.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="name">Ad</label>
                                <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="photo">Fotoğraf (200x200)</label>
                                <input type="file" class="form-control" id="photo" value="{{ old('photo') }}"
                                    name="photo" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="ordering">Sıra</label>
                                <input type="text" class="form-control" id="ordering" value="{{ old('ordering') }}"
                                    placeholder="Sıra" name="ordering" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir sıra giriniz.
                                </div>
                            </div>
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="status">Durum</label>
                                    <select name="status" class="form-control" required>
                                        <option value="" selected disabled>Durum seçiniz</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Pasif</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Lütfen durum seçiniz.
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
