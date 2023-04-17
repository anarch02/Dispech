@extends('layouts.admin')

@section('content')
<h2 class="text-center">{{__('Список организаций')}}</h2>

<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newOrganization">
  <i class="bi bi-plus-circle"></i>{{__(' Создать новую организацию')}} 
</button>

<table class="table table-striped table-sm mt-2">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Наименование')}} </th>
        <th scope="col"> {{__('Регион')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($organizations as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->name}} </td>
            <td> {{$item->region->title}} </td>
            <td>
              <a href="{{route('organizations.edit', $item->id)}}" class="btn">
                <i class="bi bi-pencil-square"></i>
              </a>
              <button type="button" 
              data-bs-toggle="modal"
              data-bs-target="#deleteOrganization"
              id="delete-organization-button" 
              data-id="{{$item->id}}"
              class="btn">
              <i class="bi bi-trash"></i> 
            </button>
            </td>
          </tr>
        @endforeach
    </tbody>
    
</table>
{{ $organizations->links('pagination::bootstrap-5') }}

<!-- Modal -->
<div class="modal fade" id="newOrganization" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">
      <form action="{{route('organizations.store')}}" method="post" id="add-organization-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создание новый организации')}} </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

          <div>
            <label for="title"> {{__('Наименоание')}} </label>
            <input class="form-control" autocomplete="off" type="text" name="name" id="name">
          </div>

          <div>
            <label for="title"> {{__('Регион')}} </label>
            {{-- <input class="form-control" type="text" name="title" id="title"> --}}
            {{-- <label for="state" class="form-label">State</label> --}}
            <select name="region_id" class="form-control" id="region_id" required="">
              <option >{{__('Выбрать...')}}</option>
              @foreach ($regions as $item)
              <option value="{{$item->id}}" class="text-dack"> {{$item->title}} </option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="title"> {{__('Адрес')}} </label>
            <input autocomplete="off" class="form-control" type="text" name="address" id="address">
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-primary">Создать</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteOrganization" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('organizations.destroy', $id = 1)}}" method="post" id="delete-organization-form">
        @method('DELETE')
        @csrf
        <div class="modal-header">
          <h1 class="modal-title text-danger fs-5" id="staticBackdropLabel"> {{__('Важно')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <input type="text" hidden name="id" id="deleteIdOrganization">
            <p class="text-danger">
              {{__('Вы действительно хотите удалть организацию?')}}
            </p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{__('Закрыть')}} </button>
          <button type="submit" class="btn btn-danger"> {{__('Удалить')}} </button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
