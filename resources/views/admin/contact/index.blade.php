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
            <div class="card mini-stat  text-white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons"
                            class="list-container table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Telefon</th>
                                    <th>Adres</th>
                                    <th>E-posta</th>
                                    <th>Twitter</th>
                                    <th>Facebook</th>
                                    <th>Instagram</th>
                                    <th>Youtube</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Düzenle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr id="row_{{ $contact->id }}">
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->adress }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->twitter }}</td>
                                        <td>{{ $contact->facebook }}</td>
                                        <td>{{ $contact->instagram }}</td>
                                        <td>{{ $contact->youtube }}</td>
                                        <td>
                                            @format_date($contact->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.contacts.edit', ['contact' => $contact->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-edit mr-2"></i>
                                                Düzenle
                                            </a>
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
