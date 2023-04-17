@extends('layouts.admin')

@section('content')


<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Организация')}} </th>
        <th scope="col"> {{__('Идентификационный номер')}} </th>
        <th scope="col"> {{__('Модель устройства')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($model->drones as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->organization->name}} </td>
            <td> {{$item->id_number}} </td>
            <td> {{$item->model->title}} </td>
          </tr>
        @endforeach
    </tbody>
</table>
@endsection
