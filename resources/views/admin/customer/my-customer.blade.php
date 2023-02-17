@extends('layouts.app')

@section('css')
    <div>
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
    </div>

@endsection

@section('title') Müşterilerim @endsection

@section('content')

    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Müşterilerim</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">
                        Sistemde kayıtlı Müşterilerim listeleniyor
                    </li>
                </ol>
            </div>

            @if (Auth::user()->permission == 3)
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i>
                            Yeni Müsteri
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- end page title -->

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
                                    <th>Statü</th>
                                    <th>İl</th>
                                    <th>Adı</th>
                                    <th>E-posta</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Görüntüle</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr id="row_{{ $customer->id }}">
                                        @if ($customer->status == 1)
                                            <td> <label class="badge bg-success">Aktif</label></td>
                                        @else
                                            <td> <label class="badge bg-danger">Pasif</label></td>
                                        @endif
                                        <td>{{ $customer->get_province->province_name }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            @format_date($customer->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.customers.show', ['customer' => $customer->id]) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-eye"></i>
                                                Görüntüle
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.customers.edit', ['customer' => $customer->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $customer->id }}"
                                                data-url="{{ route('admin.customers.destroy', ['customer' => $customer->id]) }}"
                                                class="btn btn-sm btn-danger remove-btn">
                                                <i class="fas fa-minus mr-2"></i>
                                                Sil
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

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
