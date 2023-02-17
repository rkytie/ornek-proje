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
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.accessories.store') }}"
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
                                <label class="mb-2" for="accessory_id">Birden Fazla Seçilebilir mi?</label>
                                <select name="selectable" required class="form-control" id="selectable" >
                                    <option value="">Seç</option>
                                    <option value="1" @if (old('selectable') == 1 ) selected @endif>Evet</option>
                                    <option value="2" @if (old('selectable') == 2 ) selected @endif>Hayır</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bu alanı doldurunuz.
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
