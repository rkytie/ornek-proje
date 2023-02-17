<div class="modal fade" id="editGeneralInfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form class="modal-dialog needs-validation" enctype="multipart/form-data" novalidate method="POST"
        action="{{ route('admin.customer.update_customer_info', ['customer_id' => $customer->id]) }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Genel Bilgileri Düzenleniyor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="generalInfo">
                    <h4 class="mb-3 text-info">Genel Bilgileri</h4>

                    @userPermission("2")
                    <div class="form-group mb-3">
                        <div class="mb-3">
                            <label class="mb-2" for="durum">Dürüm</label>
                            <select name="status" class="form-control" id="durum" required>
                                <option value="">Seç</option>
                                <option value="0" @if ($customer->status == 0) selected @endif>Pasif</option>
                                <option value="1" @if ($customer->status == 1) selected @endif>Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                Dümümü seçiniz lütfen
                            </div>
                        </div>
                    </div>
                    @enduserPermission

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2" for="name">Ad</label>
                                <input type="text" class="form-control" id="name" value="{{ $customer->name }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli ad girin.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2" for="surname">Soyad</label>
                                <input type="text" class="form-control" id="surname"
                                    value="{{ $customer->surname }}" placeholder="Soyad" name="surname" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli soayad girin.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input class="form-control" type="tel" name="phone" id="phone"  value="{{$customer->phone}}" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli telefon giriniz.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="mb-2">Cinsiyet</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                        @if ($customer->gender == 1) checked @endif value="1" required>
                                    <label class="form-check-label" for="male">
                                        Erkek
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        @if ($customer->gender == 2) checked @endif value="2" required>
                                    <label class="form-check-label" for="female">
                                        Kadın
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2" for="birth_date">Doğum Tarihi</label>
                        <input type="date" class="form-control" id="birth_date" placeholder="Doğum tarihi"
                            name="birth_date" value="{{ $customer->birth_date }}" required>
                        <div class="invalid-feedback">
                            Doğum tarihi giriniz.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2" for="email">E-posta</label>
                        <input type="email" class="form-control" id="email" placeholder="E-posta" name="email"
                            value="{{ $customer->email }}" required>
                        <div class="invalid-feedback">
                            Doğum tarihi giriniz.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="mb-3">
                            <label for="work" class="form-label">Meslek</label>
                            <input class="form-control" type="text" name="work" id="work"
                                value="{{ $customer->work }}" required>
                            <div class="invalid-feedback">
                                Lütfen geçerli meslek girin.
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2" for="description">Açıklama</label>
                        <textarea id="description" class="form-control" rows="3" placeholder="Açıklama giriniz.."
                            name="description">{{ $customer->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Profile Resmi</label>
                            <input class="form-control" type="file" name="image" id="profileImage" accept="image/*">
                            <div class="invalid-feedback">
                                Lütfen geçerli resmi girin.
                            </div>
                        </div>
                    </div>
                    <div class="social-media">
                        <h4 class="mb-3 text-info">Sosyal Medya Bilgileri</h4>
                        <div class="row">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook Profil Linki</label>
                                    <input class="form-control" type="url" name="facebook" id="facebook" value="{{$customer->facebook}}" >
                                    <div class="invalid-feedback">
                                        Lütfen geçerli linki giriniz.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram Profil Linki</label>
                                    <input class="form-control" type="url" name="instagram" id="instagram"  value="{{$customer->instagram}}" >
                                    <div class="invalid-feedback">
                                        Lütfen geçerli linki giriniz.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="twitter" class="form-label">Twitter Profil Linki</label>
                                    <input class="form-control" type="url" name="twitter" id="twitter"  value="{{$customer->twitter}}" >
                                    <div class="invalid-feedback">
                                        Lütfen geçerli linki giriniz.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i>
                    Düzenle
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>
