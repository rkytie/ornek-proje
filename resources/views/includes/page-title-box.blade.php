<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">{{ $pageTitle ?? 'title' }}</h6>
            <ol class="breadcrumb m-0">
            </ol>
        </div>


        @isset($action)
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    <a href="{{ $link ?? '#' }}" class="btn btn-info">
                        <i class="{{ $icon ?? 'fas fa-plus-circle' }}"></i> {{ $action ?? 'Action' }}
                    </a>
                </div>
            </div>
        @endisset

    </div>

    <div class="row align-items-right">
      <div class="col-md-12">
      <div>
          <button type="button" class="btn btn-sm btn-success" onclick="history.back()">
              <i class="fas fa-arrow-left"></i>
              Geri Dön
          </button>
      </div>
    </div>
</div>
</div>
