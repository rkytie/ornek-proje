@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') İletişim Bilgileri @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"İletişim Bilgileri",
    ])
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
          <div class="card directory-card">
              <div class="p-3 bg-transparent card-header d-flex justify-content-between">
                  <h6 class="mt-1 text-uppercase">Daire Genel Bilgileri</h6>

              </div>
              <div class="card-body">
                  <p><b>Mağaza Adı: </b>{{ $store->name }}</p>
                  <p><b><img src="{{ get_image($store->photo) }}" height="50" alt="logo"></p>

                  <hr>
                  <div class="row">
                      <div class="col-md-12">
                          <p><b>Adres :</b> {{ $store->adress }}</p>
                          <p><b>Telefon :  </b>{{ $store->phone }}</p>
                          <p><b>E-posta : </b>{{ $store->user->email }}</p>
                          <p><b>Durumu: </b> @switch($store->status)
                              @case(1)
                                  <label class="badge bg-light">Aktif </label>
                              @break
                              @case(2)
                                  <label class="badge bg-primary">Onay Bekliyor</label>
                              @break
                              @case(3)
                                  <label class="badge bg-warning">Reddedildi</label>
                              @break

                              @default
                                  <label class="badge bg-light">Belirlenmemiş</label>
                          @endswitch </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mini-stat  text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons"
                            class="list-container table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Mağaza Adı</th>
                                    <th>Adres</th>
                                    <th>Telefon</th>
                                    <th>E-posta</th>
                                    <th>Fotoğraf</th>
                                    <th>Durumu</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Düzenle</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr id="row_{{ $store->id }}">
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->adress }}</td>
                                        <td>{{ $store->phone }}</td>
                                        <td>{{ $store->user->email }}</td>
                                        <td><img src="{{ get_image($store->photo) }}" height="50" alt="logo"> </td>

                                        <td>@switch($store->status)
                                            @case(1)
                                                <label class="badge bg-light">Aktif </label>
                                            @break
                                            @case(2)
                                                <label class="badge bg-primary">Onay Bekliyor</label>
                                            @break
                                            @case(3)
                                                <label class="badge bg-warning">Reddedildi</label>
                                            @break

                                            @default
                                                <label class="badge bg-light">Belirlenmemiş</label>
                                        @endswitch
                                      </td>
                                        <td>
                                            @format_date($store->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>

                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection

@section('script')
    <x-datatable-js-link />
@endsection
