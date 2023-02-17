@extends('layouts.app')

@section('title') Yeni Daire @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Daire Yönetimi",
    "pageDescription"=>"Sistemde yeni daire oluşturmak için alanları doldurun.",
    ])
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.apartments.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Daire Adı</label>
                                      <div class="col-lg-9">
                                          <input id="txtFirstNameBilling" name="name" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="room_id" class="col-lg-3 col-form-label">Oda Sayısı</label>
                                      <div class="col-lg-9">
                                        <select name="room_id" class="form-select">
                                          @foreach($rooms as $room)
                                            <option value="{{ $room->id}}">{{ $room->type }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Tip</label>
                                      <div class="col-lg-9">
                                        <select name="type_id" class="form-select">
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Cephe</label>
                                      <div class="col-lg-9">
                                        <select name="facade_id" class="form-select">
                                          @foreach($facades as $facade)
                                            <option value="{{ $facade->id }}">{{ $facade->name }}</option>
                                          @endforeach

                                        </select>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Daire Numarası</label>
                                      <div class="col-lg-9">
                                          <input id="txtFirstNameBilling" name="number" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Fiyat</label>
                                      <div class="col-lg-9">
                                          <input id="txtFirstNameBilling" name="price" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Net m2</label>
                                      <div class="col-lg-9">
                                          <input id="txtFirstNameBilling" name="square" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Brüt m2</label>
                                      <div class="col-lg-9">
                                          <input id="txtFirstNameBilling" name="gross_square" type="text" class="form-control">
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Durumu</label>
                                      <div class="col-lg-9">
                                        <select name="status_id" class="form-select">
                                          @foreach($statutes as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="row mb-3">
                                      <label for="txtFirstNameBilling" class="col-lg-3 col-form-label">Açıklama</label>
                                      <div class="col-lg-9">
                                          <textarea name="description" rows="8" cols="80"></textarea>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </section>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-plus mr-2"></i>
                                Ekle
                            </button>
                        </div>
                        <input type="hidden" name="floor_id" value="{{ $_GET['id'] }}">
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- end row -->

@endsection
