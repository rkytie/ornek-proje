<div class="col-lg-2 col-sm-12">
  <h6>Proje Filtreleme</h6>
  <form class="" action="{{ route('admin.customer.filter') }}" method="post">
    @csrf
    <label for="validationCustom04" class="form-label">Proje</label>
        @php
        use App\Models\Project;
        $projects = Project::get()->all();
        @endphp
            
            @foreach($projects as $project)
            <div class="col-6" style="margin-bottom: 15px;">
                <div class="form-check">
                    <input class="form-check-input" value="{{ $project->id }}"   type="checkbox" name="projects[]" id="{{ $project->id }}">
                    <label class="form-check-label" for="{{ $project->id }}">
                      {{ $project->name }}
                    </label>
                </div>
            </div>
            @endforeach
      <button type="submit"
          class="btn btn-sm btn-success">
          <i class="fas fa-filter"></i>
          Filtrele
      </button>
    </form><br>
    <h6>Fiyat Aralığı Filtreleme</h6>
    <form class="" action="{{ route('admin.customer.price.filter') }}" method="post">
      @csrf
      <label for="validationCustom04" class="form-label">Fiyat</label>
      <input type="text" name="low" class="form-control" placeholder="En az" value="{{ old('low')}}"> <hr>
      <input type="text" name="max" placeholder="En çok" class="form-control" value="{{ old('max')}}">
      <br>
        <button type="submit"
            class="btn btn-sm btn-success">
            <i class="fas fa-filter"></i>
            Filtrele
        </button>
      </form>
</div>
