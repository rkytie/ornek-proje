<div class="modal fade" id="editOtherInfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form class="modal-dialog needs-validation" enctype="multipart/form-data" novalidate method="POST"
        action="{{ route('admin.customer.update_customer_info', ['customer_id' => $customer->id,'action'=>'other_info']) }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Diğer Bilgileri Düzenleniyor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="social-media">
                    <h4 class="mb-3 text-info">Diğer Bilgileri</h4>

                    <div class="other-info">
                        <div class="form-group mb-3">
                            <label class="mb-2" for="you_found_us">Bizi nereden buldu?</label>
                            <select name="you_found_us" class="form-control" id="you_found_us" required>
                                <option value="">Seç</option>
                                <option value="1" @if ($customer->other_info!=null &&  $customer->other_info->you_found_us == 1) selected @endif>Web Sitesi</option>
                                <option value="2" @if ($customer->other_info!=null &&  $customer->other_info->you_found_us == 2) selected @endif>Sosyal Medya</option>
                                <option value="3" @if ($customer->other_info!=null &&  $customer->other_info->you_found_us == 3) selected @endif>Ziyaret</option>
                                <option value="4" @if ($customer->other_info!=null &&  $customer->other_info->you_found_us == 4) selected @endif>Telefon görüşmesi</option>
                            </select>
                            <div class="invalid-feedback">
                                Bu alanı doldurunuz.
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-2" for="other_info_description">Kısa Açıklama</label>
                            <textarea id="other_info_description" class="form-control" rows="7"
                                placeholder="Kısa açıklama girebilirsiniz.."
                                name="other_info_description">{{ $customer->other_info->description??"" }}</textarea>
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
