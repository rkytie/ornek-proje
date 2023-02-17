@extends('layouts.app')

@section('title') Kayıtlı Müsteri @endsection

@section('css')
    <x-datatable-css-link />
@endsection


@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Müsteriler",
    "pageDescription"=>"Sistemde kayıtlı müsteriler listeleniyor",
    "action"=>"Yeni Müşteri",
    "icon" =>"fas fa-plus",
    "link" =>route("admin.customers.create")
    ])
    <!-- end page title -->

    <div class="row">
      @include('admin.customer.partials.search-side')
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons"
                            class="list-container table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Statü</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>Telefon</th>
                                    <th>İlgilendiği Projeler</th>
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
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->surname }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>@foreach($customer->Projects as $project) {{ $project->name }}, @endforeach</td>
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
                                                <i class="fas fa-user-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $customer->id }}"
                                                data-url="{{ route('admin.customers.destroy', ['customer' => $customer->id]) }}"
                                                class="btn btn-sm btn-danger remove-btn">
                                                <i class="fas fa-user-minus mr-2"></i>
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
    <!-- end row -->

@endsection

@section('script')
    <x-datatable-js-link />
@endsection
