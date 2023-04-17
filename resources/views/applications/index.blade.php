@extends('layouts.app')

@section('content')
<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Организация')}} </th>
        <th scope="col"> {{__('ФИО отправителя')}} </th>
        <th scope="col"> {{__('Количество устройтсв')}} </th>
        <th scope="col"> {{__('Дата создания')}} </th>
        <th scope="col"> {{__('Статус')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($applications as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            {{-- <td> {{dd($item->drones)}} </td> --}}
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
                <i class="bi bi-exclamation-lg" style="font-size: 1.5em; color: rgb(156, 14, 14);"></i>
              @endif 
            </td>
            
            <td class="d-flex flex-wrap">
              <a href="{{route('organization.application.show', $item->id)}}"
                class="btn">
                  <i class="bi bi-eye"></i>
              </a>

              {{-- <form action="{{route('user.info')}}" method="post">
                @csrf
                <input name="id" type="text" hidden value="{{$item->id}}">
                <button class="btn btn-warning" type="submit">{{__('report')}}</button>
              </form> --}}
            </td>
          </tr>
        @endforeach
    </tbody>
    
</table>
{{ $applications->links('pagination::bootstrap-5') }}

@endsection
