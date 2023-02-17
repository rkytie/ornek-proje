@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') Ürünler @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    "pageTitle" => "Ürün",
    "action"=>"Yeni Ürün",
    "icon" =>"fas fa-plus",
    "link" =>route("admin.products.create")
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
                                    <th>Ürün Adı</th>
                                    <th>Minimum Yükseklik</th>
                                    <th>Maksimum Yükseklik</th>
                                    <th>Minimum Genişlik</th>
                                    <th>Maksimum Genişlik</th>
                                    <th>Fotoğraf</th>
                                    <th>Oluşturulduğu Tarih</th>
                                    <th>Cam Seçimleri</th>
                                    <th>PVC Seçimleri</th>
                                    <th>Kulplar</th>
                                    <th>Renkler</th>
                                    <th>Cam Özellikleri</th>
                                    <th>Açılımlar</th>
                                    <th>Varsayılan Açılımlar</th>
                                    <th>Çıtalar</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr id="row_{{ $product->id }}">
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->min_height }}</td>
                                        <td>{{ $product->min_height }}</td>
                                        <td>{{ $product->min_width }}</td>
                                        <td>{{ $product->max_width }}</td>
                                        <td><img src="@if(isset($product->images()->skip(1-1)->first()->url)) {{ get_image($product->images()->skip(1-1)->first()->url) }} @endif" height="75" alt="logo"> </td>
                                        <td>
                                            @format_date($product->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.windows', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Cam seç
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.pvcs', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Alüminyumlar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.handles', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Kulplar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.colors', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Renkler
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.glass_features', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Cam Özellikleri
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.wings', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Kanatlar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.default.wings', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Varsayılan Açılımlar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.slats', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                Çıtalar
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $product->id }}"
                                                data-url="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
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
