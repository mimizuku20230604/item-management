
@if (session('success'))
  <div class="alert alert-info">
    {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

@if (session('update'))
  <div class="alert alert-success">
    {{ session('update') }}
  </div>
@endif

@if (session('delete'))
  <div class="alert alert-warning">
    {{ session('delete') }}
  </div>
@endif
