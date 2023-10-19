
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

@if($errors->any())
<div class="alert alert-danger">
    入力画面へ戻り、エラー箇所を修正してください。
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
