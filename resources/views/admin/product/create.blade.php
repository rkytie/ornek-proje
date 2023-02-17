@extends('layouts.app')

@section('title') Yeni Ürün @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Ürün Ekle",
    ])
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.products.store') }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="name">Ürün Adı</label>
                                <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                    placeholder="Ad" name="name" required>
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="mb-2" for="price">Fiyat (Eğer fiyat sabitse bunu doldurunuz)</label>
                                <input type="text" class="form-control" id="price" value="{{ old('price') }}"
                                    placeholder="Fiyat" name="price" >
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>



                            <div class="form-group mb-3">
                                <label class="mb-2" for="images">Fotoğraf Galerisi</label>
                                <input type="file" class="form-control" id="images" 
                                name="images[]" multiple>
                            </div>
                            
                            
                            <div class="form-group mb-3">
                                <label class="mb-2" for="content">İçerik</label>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control"  id="content" value="{{ old('description') }}" name="description"></textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir içerik giriniz.
                                    </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="mb-2" for="price">Sıra</label>
                                <input type="text" class="form-control" id="ordering" value="{{ old('ordering') }}"
                                    placeholder="Sıra" name="ordering" >
                                <div class="invalid-feedback">
                                    Lütfen geçerli bir isim giriniz.
                                </div>
                            </div>


                            <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Kategori</label>
                                  <select name="category_id" required class="form-control" id="category_id" >
                                      <option value="">Seç</option>
                                      @foreach($categories as $category)
                                      <option value="{{ $category->id }}" @if (old('category_id') == $category->id ) selected @endif>{{ $category->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Varsayılan Minimum Yükseklik</label>
                                      <input type="text" class="form-control" id="min_height" value="{{ old('min_height') }}"
                                          placeholder="" name="min_height" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>

                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Maksimum Yükseklik (cm)</label>
                                      <input type="text" class="form-control" id="max_height" value="{{ old('max_height') }}"
                                          placeholder="" name="max_height" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Varsayılan Minimum Genişlik(cm)</label>
                                      <input type="text" class="form-control" id="min_width" value="{{ old('min_width') }}"
                                          placeholder="" name="min_width" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Maksimum Genişlik(cm)</label>
                                      <input type="text" class="form-control" id="max_width" value="{{ old('max_width') }}"
                                          placeholder="" name="max_width" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Kanat Sayısı</label>
                                      <input type="text" class="form-control" id="wing" value="{{ old('wing') }}"
                                          placeholder="" name="wing" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="name">Dikey Sayısı</label>
                                    <input type="text" class="form-control" id="number_of_verticals" value="{{ old('number_of_horizontal') }}"
                                         name="number_of_verticals" required>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir isim giriniz.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="name">Yatay Sayısı</label>
                                    <input type="text" class="form-control" id="number_of_horizontal" value="{{ old('number_of_verticals') }}" name="number_of_horizontal" required>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir isim giriniz.
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan PVC Seçimi</label>
                                  <select name="pvc_id" required class="form-control" id="pvc_id" >
                                      <option value="">Seç</option>
                                      @foreach($pvcs as $pvc)
                                      <option value="{{ $pvc->id }}" @if (old('pvc_id') == $pvc->id ) selected @endif>{{ $pvc->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Cam Seçimi</label>
                                  <select name="window_id" required class="form-control" id="window_id" >
                                      <option value="">Seç</option>
                                      @foreach($windows as $window)
                                      <option value="{{ $window->id }}" @if (old('window_id') == $window->id ) selected @endif>{{ $window->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>
                                <div class="form-group mb-3">
                                  <label class="mb-2" for="color_id">Varsayılan Renk Seçimi</label>
                                  <select name="color_id" required class="form-control" id="color_id" >
                                      <option value="">Seç</option>
                                      @foreach($colors as $color)
                                      <option value="{{ $color->id }}" @if (old('color_id') == $color->id ) selected @endif>{{ $color->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Kulp Seçimi</label>
                                  <select name="handle_id" required class="form-control" id="pvc_id" >
                                      <option value="">Seç</option>
                                      @foreach($handles as $handle)
                                      <option value="{{ $handle->id }}" @if (old('handle_id') == $handle->id ) selected @endif>{{ $handle->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Pencere Özelliği Seçimi</label>
                                  <select name="glass_feature_id" required class="form-control" id="glass_feature_id" >
                                      <option value="">Seç</option>
                                      @foreach($glass_features as $glass_feature)
                                      <option value="{{ $glass_feature->id }}" @if (old('glass_feature_id') == $glass_feature->id ) selected @endif>{{ $glass_feature->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>


                              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </section>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-plus mr-2"></i>
                                    Ekle
                                </button>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


@endsection
