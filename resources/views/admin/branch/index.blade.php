@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') Kayıtlı Şübeler @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Şübeler",
    "pageDescription"=>"Sistemde kayıtlı Şübeler listeleniyor",
    "action"=>"Yeni Şübe",
    "icon" =>"fas fa-plus",
    "link" =>route("admin.branchs.create")
    ])
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
                                    <th>Merkez mi?</th>
                                    <th>İl</th>
                                    <th>Adı</th>
                                    <th>E-posta</th>
                                    <th>Telefon</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($branchs as $branch)
                                    <tr id="row_{{ $branch->id }}">
                                        @if ($branch->type == 1)
                                            <td> <label class="badge bg-success">Evet</label></td>
                                        @else
                                            <td> <label class="badge bg-warning">Hayır</label></td>
                                        @endif
                                        <td>{{ $branch->get_province->province_name }}</td>
                                        <td>{{ $branch->name }}</td>
                                        <td>{{ $branch->email }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td>
                                            @format_date($branch->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.branchs.edit', ['branch' => $branch->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $branch->id }}"
                                                data-url="{{ route('admin.branchs.destroy', ['branch' => $branch->id]) }}"
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
