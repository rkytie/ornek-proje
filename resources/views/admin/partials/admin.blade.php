<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="assets/images/services-icon/01.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Kullanıcılar</h5>
                    <h4 class="fw-medium font-size-24">{{ $countUser }}</h4>
                </div>
                <div class="pt-2">
                    <div class="float-end">
                        <a href="{{ route('admin.users.index') }}" class="text-white-50"><i
                                class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0 mt-1">Daha fazla...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="assets/images/services-icon/02.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">YÖNETİCİLER</h5>
                    <h4 class="fw-medium font-size-24">{{ $countManager }}</h4>
                </div>
                <div class="pt-2">
                    <div class="float-end">
                        <a href="{{ route('admin.managers.index') }}" class="text-white-50"><i
                                class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0 mt-1">Daha fazla...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="assets/images/services-icon/03.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Personel</h5>
                    <h4 class="fw-medium font-size-24">{{ $countStaff }}</h4>

                </div>
                <div class="pt-2">
                    <div class="float-end">
                        <a href="{{ route('admin.staffs.index') }}" class="text-white-50"><i
                                class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0 mt-1">Daha fazla...</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="assets/images/services-icon/04.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Müsteriler</h5>
                    <h4 class="fw-medium font-size-24">{{ count($customers) }}</h4>

                </div>
                <div class="pt-2">
                    <div class="float-end">
                        <a href="{{ route('admin.customers.index') }}" class="text-white-50"><i
                                class="mdi mdi-arrow-right h5"></i></a>
                    </div>

                    <p class="text-white-50 mb-0 mt-1">Daha fazla...</p>
                </div>
            </div>
        </div>
    </div>
</div>
