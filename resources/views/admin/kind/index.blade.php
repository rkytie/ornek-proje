@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') Aksesuar Çeşitleri @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Aksesuar Çeşitleri",
    "action"=>"Yeni Aksesuar",
    "icon" =>"fas fa-plus",
    "link" =>route("admin.kinds.create")
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
                                    <th>Adı</th>
                                    <th>Aksesuar Kategorisi</th>
                                    <th>Fotoğraf</th>
                                    <th>Hesaplama</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($kinds as $kind)
                                    <tr id="row_{{ $kind->id }}">
                                        <td>{{ $kind->name }}</td>
                                        <td>{{ $kind->accessory->name }}</td>
                                        <td><img src="{{ get_image($kind->photo) }}" height="75" alt="logo"> </td>
                                        <td>@if($kind->calculation == 1) Sabit Fiyat @elseif($kind->calculation == 2) Alana Göre @elseif($kind->calculation == 3) Çevreye Göre @elseif($kind->calculation == 4) Kanat Sayısına Göre @endif</td>
                                        <td>
                                            @format_date($kind->created_at)
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="{{ route('admin.kinds.edit', ['kind' => $kind->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $kind->id }}"
                                                data-url="{{ route('admin.kinds.destroy', ['kind' => $kind->id]) }}"
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
