@extends('layouts.app')

@section('content')

<h3 class="text-center">
  {{$organization->name}}
</h3>
<h4 class="text-center">
  {{$organization->region->title}}
</h4>

<div class="row">
  <div class="col-sm-6">
    <div class="widget-flat card">
      <div class="card-body">
        <div class="float-end">
          <i class="mdi mdi-account-multiple widget-icon"></i>
        </div>
        <h5 class="fw-normal mt-0 text-muted" title="Number of Customers">Количество пилотов</h5>
        <h3 class="mt-3 mb-3">
          {{$pilots}}
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
        <h5 class="fw-normal mt-0 text-muted" title="Number of Customers">Количество устройтсв</h5>
        <h3 class="mt-3 mb-3">
          {{$drones}}
        </h3>
      </div>
    </div>
  </div>

</div>

@endsection
