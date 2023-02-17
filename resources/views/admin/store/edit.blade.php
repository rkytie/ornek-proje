@extends('layouts.app')

@section('title') İletişim Düzenle @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"İletişim Yönetimi",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.contacts.update', $contact->id) }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                      {{ method_field('PUT') }}
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="content">Footer İçerik</label>
                                <input type="text" class="form-control" id="content" value="{{ $contact->content }}"
                                    placeholder="Footer İçerik" name="content" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="copyright">Copyright</label>
                                <input type="text" class="form-control" id="copyright" value="{{ $contact->copyright }}"
                                    placeholder="Copyright" name="copyright" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="phone">Telefon</label>
                                <input type="text" class="form-control" id="phone" value="{{ $contact->phone }}"
                                    placeholder="Telefon" name="phone" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="adress">Adres</label>
                                <input type="text" class="form-control" id="adress" value="{{ $contact->adress }}"
                                    placeholder="Adres" name="adress" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">E-posta</label>
                                <input type="text" class="form-control" id="email" value="{{ $contact->email }}"
                                    placeholder="E-posta" name="email" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Twitter</label>
                                <input type="text" class="form-control" id="twitter" value="{{ $contact->twitter }}"
                                    placeholder="Twitter" name="twitter" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Facebook</label>
                                <input type="text" class="form-control" id="facebook" value="{{ $contact->facebook }}"
                                    placeholder="Facebook" name="facebook" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">Instagram</label>
                                <input type="text" class="form-control" id="instagram" value="{{ $contact->instagram }}"
                                    placeholder="Instagram" name="instagram" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="email">YouTube</label>
                                <input type="text" class="form-control" id="youtube" value="{{ $contact->youtube }}"
                                    placeholder="Youtube" name="youtube" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>
                        </section>

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
    <!-- end row -->

@endsection
