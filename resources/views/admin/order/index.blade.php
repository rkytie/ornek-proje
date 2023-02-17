@extends('layouts.app')

@section('css')
<div>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
</div>

@endsection

@section('title') Siparişler @endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    "pageTitle" => "Siparişler",
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
                                    <th>Soyad</th>
                                    <th>E-posta</th>
                                    <th>Telefon</th>
                                    <th>Adres</th>
                                    <th>Sipariş Detayı</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $order)
                                    <tr id="row_{{ $order->id }}">

                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->surname }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->adress }}</td>
                                        <td>{{ $order->detail }}</td>
                                        
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
