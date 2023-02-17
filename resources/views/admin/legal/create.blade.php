@extends('layouts.app')

@section('title')
    Yeni İçerik
@endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box', [
        'pageTitle' => 'İçerik Ekle',
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.legals.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="title">Başlık</label>
                                <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                                    placeholder="Başlık" name="title" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" value="{{ old('slug') }}"
                                    placeholder="/link" name="slug" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="content">İçerik</label>

                                <div class="form-group">
                                    <textarea class="ckeditor form-control" id="content" value="{{ old('content') }}" name="content"></textarea>
                                </div>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir içerik giriniz.
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
