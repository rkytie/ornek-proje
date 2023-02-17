@extends('layouts.app')

@section('title') Yeni Ürün @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Ürün Düzenle",
    ])
    <!-- end page title -->

    {{ $errors }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="needs-validation" novalidate action="{{ route('admin.products.update', ['product' => $product->id]) }}"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section>
                            <div class="form-group mb-3">
                                <label class="mb-2" for="name">Ürün Adı</label>
                                <input type="text" class="form-control" id="name" value="{{ $product->name }}"
                                    placeholder="Ad" name="name" required>
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
                                        <textarea class="ckeditor form-control"  id="content" name="description">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir içerik giriniz.
                                    </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="mb-2" for="price">Sıra</label>
                                <input type="text" class="form-control" id="ordering" value="{{ $product->ordering }}"
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
                                      <option value="{{ $category->id }}" @if ($product->category_id == $category->id ) selected @endif>{{ $category->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                              </div>
                              <div class="col-lg-12">
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Varsayılan Minimum Yükseklik</label>
                                      <input type="text" class="form-control" id="min_height" value="{{ $product->min_height }}"
                                          placeholder="" name="min_height" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>

                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Maksimum Yükseklik (cm)</label>
                                      <input type="text" class="form-control" id="max_height" value="{{ $product->max_height }}"
                                          placeholder="" name="max_height" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Varsayılan Minimum Genişlik(cm)</label>
                                      <input type="text" class="form-control" id="min_width" value="{{ $product->min_width }}"
                                          placeholder="" name="min_width" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Maksimum Genişlik(cm)</label>
                                      <input type="text" class="form-control" id="max_width" value="{{ $product->max_width }}"
                                          placeholder="" name="max_width" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                  <div class="form-group mb-3">
                                      <label class="mb-2" for="name">Kanat Sayısı</label>
                                      <input type="text" class="form-control" id="wing" value="{{ $product->wing }}"
                                          placeholder="" name="wing" required>
                                      <div class="invalid-feedback">
                                          Lütfen geçerli bir isim giriniz.
                                      </div>
                                  </div>
                                
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="name">Dikey Sayısı</label>
                                    <input type="text" class="form-control" id="number_of_verticals" value="{{ $product->number_of_verticals }}"
                                         name="number_of_verticals" required>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir isim giriniz.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-2" for="name">Yatay Sayısı</label>
                                    <input type="text" class="form-control" id="number_of_horizontal" value="{{ $product->number_of_horizontal }}" name="number_of_horizontal" required>
                                    <div class="invalid-feedback">
                                        Lütfen geçerli bir isim giriniz.
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Profil Seçimi</label>
                                  <select name="pvc_id" required class="form-control" id="pvc_id" >
                                      <option value="">Seç</option>
                                      @foreach($pvcs as $pvc)
                                      <option value="{{ $pvc->id }}" @if ($product->pvc_id == $pvc->id ) selected @endif>{{ $pvc->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Pencere Seçimi</label>
                                  <select name="window_id" required class="form-control" id="window_id" >
                                      <option value="">Seç</option>
                                      @foreach($windows as $window)
                                      <option value="{{ $window->id }}" @if ($product->window_id == $window->id ) selected @endif>{{ $window->name}}</option>
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
                                      <option value="{{ $color->id }}" @if ($product->color_id == $color->id ) selected @endif>{{ $color->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Kulp Seçimi</label>
                                  <select name="handle_id" required class="form-control" id="handle_id" >
                                      <option value="">Seç</option>
                                      @foreach($handles as $handle)
                                      <option value="{{ $handle->id }}" @if ($product->handle_id == $handle->id ) selected @endif>{{ $handle->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>

                                <div class="form-group mb-3">
                                  <label class="mb-2" for="category_id">Varsayılan Cam Özelliği Seçimi</label>
                                  <select name="glass_feature_id" class="form-control" id="pvc_id" >
                                      <option value="">Seç</option>
                                      @foreach($glass_features as $glass_feature)
                                      <option value="{{ $glass_feature->id }}" @if ($product->glass_feature_id == $glass_feature->id ) selected @endif>{{ $glass_feature->name}}</option>
                                      @endforeach
                                  </select>
                                  <div class="invalid-feedback">
                                      Bu alanı doldurunuz.
                                  </div>
                                </div>


                              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                    <th>Fotoğraf</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($product->images as $images)
                                    <tr id="row_{{ $images->id }}">
                                        <td><img src="{{ get_image($images->url) }}" height="75" alt="logo"> </td>
                                        <td>
                                            <button data-id="{{ $images->id }}"
                                                data-url="{{ route('admin.products.image.destroy', ['id' => $images->id]) }}"
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
