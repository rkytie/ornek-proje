@extends('layouts.app')

@section('title') kayıtlı kullanıcılar @endsection

@section('css')
    <x-datatable-css-link />
@endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Kullanıcılar",
    "pageDescription"=>"Sistemde kayıtlı kullanıcılar listeleniyor",
    "action"=>"Yeni kullanıcı",
    "icon" =>"fas fa-user-plus",
    "link" =>route("admin.users.create")
    ])
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatable-buttons"
                            class="list-container table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Dürüm</th>
                                    <th>Statü</th>
                                    <th>Ad</th>
                                    <th>Soyad</th>
                                    <th>E-posta</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Düzenle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="row_{{ $user->id }}">
                                        <td>
                                            @switch($user->permission)
                                                @case(1)
                                                    <label class="badge bg-light">Admin </label>
                                                    <span>{{ get_user_id()==$user->id?"(Benim)":"" }}</span>
                                                @break
                                                @case(2)
                                                    <label class="badge bg-primary">Yönetici</label>
                                                @break
                                                @case(3)
                                                    <label class="badge bg-warning">Personel</label>
                                                @break
                                                @case(4)
                                                    <label class="badge bg-info">Müsteri</label>
                                                @break
                                                @default
                                                    <label class="badge bg-light">Belirlenmemiş</label>
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($user->status)
                                                @case(0)
                                                    <label class="badge bg-danger">Pasif</label>
                                                @break
                                                @case(1)
                                                    <label class="badge bg-success">Aktif</label>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @format_date($user->created_at)
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-user-edit mr-2"></i>
                                                Düzenle
                                            </a>
                                        </td>
                                        <td>
                                            <button data-id="{{ $user->id }}"
                                                data-url="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
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
