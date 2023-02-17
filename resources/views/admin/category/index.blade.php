@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') Kategoriler @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    "pageTitle" => "Kategori",
    "action"=>"Yeni Kategori",
    "icon" =>"fas fa-plus",
    "link" =>route("admin.categories.create")
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
                                    <th>Ad</th>
                                    <th>Fotoğraf</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categoriesUst as $categoryUst)
                                    <tr id="row_{{ $categoryUst->id }}">

                                        <td>{{ $categoryUst->name }}</td>
                                        <td><img src="{{ get_image($categoryUst->photo) }}" height="75"> </td>
                                        <td>
                                            @format_date($categoryUst->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.categories.edit', ['category' => $categoryUst->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $categoryUst->id }}"
                                                data-url="{{ route('admin.categories.destroy', ['category' => $categoryUst->id]) }}"
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
    <div class="row">
        <div class="col-12">
            <div class="card mini-stat  text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4> Alt Kategoriler</h4>
                        <table id="datatable-buttons"
                            class="list-container table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Üst Kategorisi</th>
                                    <th>Fotoğraf</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categoriesAlt as $categoryAlt)
                                    <tr id="row_{{ $categoryAlt->id }}">

                                        <td>{{ $categoryAlt->name }}</td>
                                        <td>{{ $categoryAlt->category->name }} </td>
                                        <td><img src="{{ get_image($categoryAlt->photo) }}" height="75"> </td>
                                        <td>
                                            @format_date($categoryAlt->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.categories.edit', ['category' => $categoryAlt->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $categoryUst->id }}"
                                                data-url="{{ route('admin.categories.destroy', ['category' => $categoryAlt->id]) }}"
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
