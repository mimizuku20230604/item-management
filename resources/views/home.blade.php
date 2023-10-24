@extends('adminlte::page')

@section('title', 'H-Laravel社')

@section('content_header')
  <h4>ホーム</h4>
@stop

@section('content')
  {{-- @can('admin') --}}
    <span class="badge badge-pill btn-info">
      準備中
    </span>
    <div class="form-row">
      <div class="col-md-4">
        <div class="form-group">
          {{-- @include('includes.sales')  --}}
          <table class="table">
            <tbody>
              <tr>
                <td>売上</td>
                <td class="text-right">¥000,000-</td>
              </tr>
              <tr>
                <td>粗利</td>
                <td class="text-right">¥000,000-</td>
              </tr>
              <tr>
                <td>粗利率</td>
                <td class="text-right">00.00%</td>
              </tr>
                <tr>
                <td>予算</td>
                <td class="text-right">¥000,000-</td>
              </tr>
                <tr>
                <td>達成率</td>
                <td class="text-right">00.00%</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-8">
        <div class="form-group">
          {{-- @include('includes.insideInfo')  --}}
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h5 class="custom-text-color mr-3">insider information</h5>
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
    </div>
  {{-- @endcan --}}
  <br>
  {{-- @include('includes.info')  --}}
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
  <br>
  {{-- @include('includes.itemInfo')  --}}
  <div class="col-md-12">
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{asset('img/sample1.jpg')}}" alt="..." class="img-fluid" style="max-width: 100px;">
            </div>
            <div class="col-md-8">
              <div class="card-body bg-light">
                <h5 class="card-title">新商品情報</h5>
                <p class="card-text"><span class="badge badge-pill btn-info">準備中</span></p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="{{asset('img/sample1.jpg')}}" alt="..." class="img-fluid" style="max-width: 100px;">
            </div>
            <div class="col-md-8">
              <div class="card-body bg-light">
                <h5 class="card-title">新商品情報</h5>
                <p class="card-text"><span class="badge badge-pill btn-info">準備中</span></p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop



@section('footer')
  Copyright © {{ date('Y') }} H-Laravel社_商品管理システム All Rights Reserved.
@endsection

@section('css')
  {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
  <script> console.log('Hi!'); </script>
@stop

