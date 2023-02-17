@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') İndirimler @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    "pageTitle" => "İndirimler",
    "action"=>"Yeni İndirim",
    "icon" =>"fas fa-plus",
    "link" =>route("admin.discounts.create")
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
                                    <th>Sıra</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($discounts as $discount)
                                    <tr id="row_{{ $discount->id }}">
                                        <td>{{ $discount->name }}</td>
                                        <td><img src="{{ get_image($discount->photo) }}" height="50" alt="logo"> </td>
                                        <td>{{ $discount->ordering }}</td>
                                        <td>
                                            @format_date($discount->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.discounts.edit', ['discount' => $discount->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $discount->id }}"
                                                data-url="{{ route('admin.discounts.destroy', ['discount' => $discount->id]) }}"
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
