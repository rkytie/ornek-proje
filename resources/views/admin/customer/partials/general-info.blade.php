<div class="col-12">
    <div class="card directory-card">
        <div class="p-3 bg-transparent card-header d-flex justify-content-between">
            <h6 class="mt-1 text-uppercase">GENEL BİLGİLERİ</h6>
            <div>
                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editGeneralInfoModal">
                    <i class="fas fa-edit"></i>
                    Düzenle
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="{{ get_image($customer->image) }}" alt="Profil Resmi"
                     class="image-popup-vertical-fit img-fluid img-thumbnail rounded-circle avatar-lg">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="text-primary font-size-18 mb-1">{{ $customer->full_name }}</h5>
                    <p class="font-size-12 mb-2">{{ $customer->work }}</p>
                    <p class="mb-0">{{ $customer->email }}</p>
                    <p>
                        @if ($customer->status == 1)
                            <label class="badge bg-success">Aktif</label>
                        @else
                            <label class="badge bg-danger">Pasif</label>
                        @endif
                    </p>
                </div>
                <ul class="list-unstyled social-links ms-auto">
                    @if ($customer->facebook)
                        <li>
                            <a href="{{ $customer->facebook }}" target="_blank" class="btn-primary">
                                <i class="mdi mdi-facebook"></i>
                            </a>
                        </li>
                    @endif
                    @if ($customer->twitter)
                        <li>
                            <a href="{{ $customer->twitter }}" target="_blank" class="btn-info">
                                <i class="mdi mdi-twitter"></i>
                            </a>
                        </li>
                    @endif
                    @if ($customer->instagram)
                        <li>
                            <a href="{{ $customer->instagram }}" target="_blank" class="btn-warning">
                                <i class="mdi mdi-instagram"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <hr>

            <p><b>Hakkında : </b>{{ $customer->description }}</p>
            <p><b>Telefon : </b>{{ $customer->phone }}</p>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><b>Cinsiyet : </b>{{ $customer->gender == 1 ? 'Erkek' : 'Kadın' }}</p>
                    <p><b>Doğum Tarihi : </b>{{ format_date($customer->birth_date) }}</p>
                    <p><b>Meslek : </b>{{ $customer->work }}</p>
                    <p><b>Sisteme ekleme tarihi:</b> {{ format_date($customer->created_at) }}</p>
                </div>

                <div class="col-md-6">
                    <p><b>Oluşturma Tarihi : </b>{{ format_date($customer->created_date) }}</p>
                    <p><b>İlgilendiği Projeler : </b>@foreach($customer->Projects as $project) {{ $project->name }} - @endforeach &nbsp; <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editProject">
                        <i class="fas fa-edit"></i>
                        Projeleri Düzenle
                    </button></p>
                </div>
            </div>
        </div>
    </div>
</div>
