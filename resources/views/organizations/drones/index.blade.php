@extends('layouts.app')

@section('content')
<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Модель устройства')}} </th>
        <th scope="col"> {{__('Идентификационный номер')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($drones as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->model->title}} </td>
            <td> {{$item->id_number}} </td>
        </tr>
        @endforeach
    </tbody>
    
</table>

@endsection
