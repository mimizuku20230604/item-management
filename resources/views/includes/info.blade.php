  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h5 class="custom-text-color mr-3">information</h5>
        <span class="badge badge-pill btn-info">準備中</span>
      </div>
      <div class="card-body bg-light" style="max-height: 180px; overflow-y: auto;">
        <div class="card">
          <div class="card-header">
            インボイス対応書類導入について
          </div>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">...</p>
            <a href="#" class="btn btn-outline-info btn-sm">詳細情報へ</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            原材料高騰による価格改定
          </div>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">...</p>
            <a href="#" class="btn btn-outline-info btn-sm">詳細情報へ</a>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            年末年始運送会社情報
          </div>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">...</p>
            <a href="#" class="btn btn-outline-info btn-sm">詳細情報へ</a>
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
