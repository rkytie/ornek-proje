<div class="vertical-menu">

    <div data-simplebar class="h-100 loading-sidebar" id="left-sidebar">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled invisible" id="side-menu">
                <li class="text-center mb-3">
                    <h6 class="text-white">{{ Auth::user()->full_name }}</h6>
                    @switch(Auth::user()->permission)
                        @case(1)
                            <label class="badge bg-light">Admin </label>
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
                </li>


                <li>
                    <a href="{{ route('admin.index') }}" class="waves-effect">
                        <i class="fa-solid fa-house"></i><span>Anasayfa</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa-brands fa-product-hunt"></i><span>Ürün Varyasyonları</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="waves-effect">
                                <span>Kategoriler</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.brands.index') }}" class="waves-effect">
                                <span>Markalar</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.pvcs.index') }}" class="waves-effect">
                                <span>Profiller</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.windows.index') }}" class="waves-effect">
                                <span>Cam</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.handles.index') }}" class="waves-effect">
                                <span>Kulplar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.colors.index') }}" class="waves-effect">
                                <span>Renkler</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.glass-features.index') }}" class="waves-effect">
                                <span>Cam Özellikleri</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.wings.index') }}" class="waves-effect">
                                <span>Kanatlar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.slats.index') }}" class="waves-effect">
                                <span>Çıtalar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="waves-effect">
                        <i class="fa-solid fa-basket-shopping"></i><span>Ürünler</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa-solid fa-gear"></i>
                        <span>Site Ayarları</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.sliders.index') }}" class="waves-effect">

                                <span>Sliderlar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contents.index') }}" class="waves-effect">
                                <span>İçerikler</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.blogs.index') }}" class="waves-effect">
                                <span>Bloglar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.legals.index') }}" class="waves-effect">
                                <span>Yasalar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.campaigns.index') }}" class="waves-effect">
                                <span>Kampanyalar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.discounts.index') }}" class="waves-effect">
                                <span>Materyaller</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contacts.index') }}" class="waves-effect">
                                <span>İletişim</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.banks.index') }}" class="waves-effect">
                                <span>Bankalar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="waves-effect">
                        <i class="fa-solid fa-arrow-down-wide-short"></i><span>Siparişler</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.gains.index') }}" class="waves-effect">
                        <i class="fa-solid fa-chart-area"></i><span>Kazançlarım / Grafikler</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.stores.index') }}" class="waves-effect">
                        <i class="fa-solid fa-house"></i><span>Mağaza Bilgileri</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.stores.index') }}" class="waves-effect">
                        <i class="fa-solid fa-handshake"></i><span>Ticket Gönder</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.users.index') }}" class="waves-effect">
                        <i class="fas fa-users-cog"></i>
                        <span id="countUser" class="badge rounded-pill bg-white text-dark float-end"></span>
                        <span>Kullanıcı Yönetimi</span>
                    </a>
                </li>





            </ul>
        </div>

        <div class="text-light small invisible mt-5 w-100">
            <p class="text-center">
                © {{ date('Y') }} Developed by
                <a href="https://umitcanakci.blogspot.com/" class="text-light" target="_blank">
                    <i class="mdi mdi-heart text-danger"></i>
                    Ümit Çanakçı
                </a>
                <span>
                    {{ env('APP_VERSION') }}
                </span>
            </p>
        </div>
    </div>

    <!-- Sidebar -->
</div>
