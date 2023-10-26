
      <div class="col-md-8">
        <div class="form-group">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h5 class="custom-text-color mr-3">insider information</h5>
              <span class="badge badge-pill btn-info">準備中</span>
            </div>
            <div class="card-body bg-light" style="max-height: 180px; overflow-y: auto;">
              <div class="card">
                <div class="card-header">
                  健康診断について
                </div>
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <p class="card-text">...</p>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  全社MTG日程変更について
                </div>
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <p class="card-text">...</p>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  年末調整締切について
                </div>
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <p class="card-text">...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


  {{-- <div class="card-body">
    @foreach($posts as $post)
      <p>
        @if(\Carbon\Carbon::now()->diffInDays($post->created_at) <= 7)
          <span class="badge badge-primary">New</span>
        @endif
        {{ $post->content }}
      </p>
    @endforeach
  </div> --}}

@section('css')
<style>
  .custom-text-color {
    color: rgb(7, 81, 177);
  }

</style>
@stop

@section('js')
@stop