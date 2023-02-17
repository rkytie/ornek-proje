@extends('layouts.app')

@section('title')  @endsection

@section('css')
     <!-- Lightbox css -->
     <link href="{{asset('assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Arama Sonuçları"
    ])
    <!-- end page title -->
    <div class="row">
      <div class="col-2">
        <h6>Filtreler</h6>
        <form class="" action="{{ route('admin.project.filter') }}" method="post">
          @csrf
          <label for="validationCustom04" class="form-label">Proje</label>
            <select class="form-select" id="validationCustom04" >
                @foreach($projects as $projectO)
                  <option value="{{ $projectO->id }}">{{ $projectO->name }}</option>
                @endforeach
            </select><br>

          <label for="validationCustom04" class="form-label">Durum</label>
            <select class="form-select" name="status" id="validationCustom04" >
                <option selected="" disabled="" value="">Seçiniz</option>
                @foreach($status as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select><br>

            <label for="validationCustom04" class="form-label">Cephe</label>
              <select class="form-select" name="facade" id="validationCustom04" >
                  <option selected="" disabled="" value="">Seçiniz</option>
                  @foreach($facades as $facade)
                  <option value="{{ $facade->id }}">{{ $facade->name }}</option>
                  @endforeach
              </select><br>

            <label for="validationCustom04" class="form-label">Oda Sayısı</label>
              <select class="form-select" name="room" id="validationCustom04" >
                  <option selected="" disabled="" value="">Seçiniz</option>
                  @foreach($rooms as $room)
                  <option value="{{ $room->id }}">{{ $room->type }}</option>
                  @endforeach
              </select><br>

              <label for="validationCustom04" class="form-label">Tipi</label>
                <select class="form-select" name="type" id="validationCustom04" >
                    <option selected="" disabled="" value="">Seçiniz</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select><br>

                  <label for="validationCustom04" class="form-label">Kat</label>
                    <select class="form-select" name="floor" id="floor" >
                        <option selected="" disabled="" value="">Seçiniz</option>
                    </select><br>
                  <button type="submit"
                      class="btn btn-sm btn-success">
                      <i class="fas fa-filter"></i>
                      Filtrele
                  </button>
        </form>

      </div>
        <div class="col-10">
            <div class="card mini-stat  text-dark">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons"
                            class="list-container table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Durumu</th>
                                    <th>Daire Numarası</th>
                                    <th>Daire Tipi</th>
                                    <th>Cephesi</th>
                                    <th>Güncel Fiyatı</th>
                                    <th class="text-center">Görüntüle</th>
                                    <th class="text-center">Teklif Oluştur</th>
                                </tr>
                            </thead>

                            <tbody>
                                  @foreach($apartments as $apartment)
                                    <tr id="row_{{ $apartment->id }}">
                                        <td>
                                          @switch($apartment->status->id)
                                              @case(1)
                                                  <label class="badge bg-info">Satılık </label>
                                              @break
                                              @case(2)
                                                  <label class="badge bg-warning">Kiralık</label>
                                              @break
                                              @case(3)
                                                  <label class="badge bg-danger">Satılmış</label>
                                              @break
                                              @case(4)
                                                <label class="badge bg-danger">Kiralanmış</label>
                                              @break
                                              @default
                                                  <label class="badge bg-light">Belirlenmemiş</label>
                                          @endswitch
                                        </td>
                                        <td>{{ $apartment->number }}</td>
                                        <td>{{ $apartment->type->name }}</td>
                                        <td>{{ $apartment->facade->name }}</td>
                                        <td>{{ number_format($apartment->price, 2, ',', '.') }}₺</td>
                                        <td class="text-center"><a href="{{ route('admin.apartments.view', ['id' => $apartment->id]) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                            Görüntüle
                                        </a></td>
                                        <td class="text-center"><a href="{{ route('admin.apartments.view', ['id' => $apartment->id]) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-pen"></i>
                                            Teklif Oluştur
                                        </a></td>
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
    <!-- Magnific Popup-->
    <script src="{{asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Tour init js-->
    <script src="{{asset('assets/js/pages/lightbox.init.js')}}"></script>

  <script>
    $(document).ready(function () {
      var block = $('#block')
      $('#block').change(function(){
        var blockID = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/get-floor/' + blockID,
            method: 'get',
            success: function (result) {
              if (result) {
                  $('#floor').empty()
                  $('#floor').append('<option disabled>Kat Seçiniz</option>')
                  $.each(result, function (key, floor) {
                      $('#floor').append('<option value="' + floor.id +
                          '">' + floor.number + '</option>')
                  })
              } else {
                  $('#floor').empty()
              }
            }
          })
        })
      });
  </script>
@endsection
