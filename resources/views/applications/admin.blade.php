@extends('layouts.admin')

@section('content')
<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Организация')}} </th>
        <th scope="col"> {{__('Отправитель')}} </th>
        <th scope="col"> {{__('Количество устройтсв')}} </th>
        <th scope="col"> {{__('Дата отправки')}} </th>
        <th scope="col"> {{__('Статус')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($applications as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->organization->name}} </td>
            <td> {{$item->user->name}} </td>
            <td> {{count($item->drones)}} </td>
            <td> {{$item->user->created_at}} </td>

            <td> 
              @if ($item->status == true)
                <i class="bi bi-check-all" style="font-size: 1.5em; color: rgb(1, 182, 61);"></i>
              @elseif($item->comment)
                <i class="bi bi-x-circle" style="font-size: 1.5em; color: rgb(156, 14, 14);"></i>
              @elseif($item->status == 0)
                <i class="bi bi-exclamation-lg" style="font-size: 1.5em; color: rgb(231, 130, 83);"></i>
              @endif 
            </td>

            {{-- <td> {{$item->id}} </td> --}}
            <td class="d-flex flex-wrap">
              <a href="{{route('admin.application.show', $item->id)}}"
                class="btn">
                <i class="bi bi-eye"></i>
              </a>
            </td>
          </tr>
        @endforeach
    </tbody>
    
</table>
{{ $applications->links('pagination::bootstrap-5') }}

@endsection
