@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col-sm-6">
    <div class="widget-flat card">
      <div class="card-body">
        <div class="float-end">
          <i class="mdi mdi-account-multiple widget-icon"></i>
        </div>
        <h5 class="fw-normal mt-0 text-muted" title="Number of Customers">Количество организаций</h5>
        <h3 class="mt-3 mb-3">
          {{$organization}}
        </h3>
      </div>
    </div>
  </div>

    <div class="col-sm-6">
    <div class="widget-flat card">
      <div class="card-body">
        <div class="float-end">
          <i class="mdi mdi-account-multiple widget-icon"></i>
        </div>
        <h5 class="fw-normal mt-0 text-muted" title="Number of Customers">Количество дронов</h5>
        <h3 class="mt-3 mb-3">
          {{$drones}}
        </h3>
      </div>
    </div>
  </div>

</div>

@if (Auth::user()->isSuperAdmin)
    <h1>Hello world</h1>
@endif

@endsection
