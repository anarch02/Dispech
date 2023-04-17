@extends('layouts.admin')

@section('content')
<h1 class="text-center"> {{__(' Список устройств')}} </h1>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newDrone">
  <i class="bi bi-plus-circle"></i>{{__(' Создать устройство')}}
</button>

<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Идентификационный номер')}} </th>
        <th scope="col"> {{__('Организация')}} </th>
        <th scope="col"> {{__('Модель устройства')}} </th>
        <th scope="col"> {{__('Дейсвия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($drones as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->id_number}} </td>
            <td> {{$item->organization->name}} </td>
            <td> {{$item->model->title}} </td>
            <td class="d-flex flex-wrap">
              <a href="{{route('drones.edit', $item->id)}}"
                class="btn">
                  <i class="bi bi-pencil-square"></i>
              </a>
              <button 
                data-bs-toggle="modal"
                data-bs-target="#deleteDrone"
                data-id="{{$item->id}}"
                id="delete-drone-button"
                class="btn">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>
        @endforeach
    </tbody>
    
</table>
{{ $drones->links('pagination::bootstrap-5') }}

<!-- Modal -->
<div class="modal fade" id="newDrone" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('drones.store')}}" method="post" id="add-drone-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создание нового уствойства')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

          <div>
            <label for="title"> {{__('Организация')}} </label>
            <select name="organization_id" class="form-control" id="organization_id" required="">
              <option >{{__('Choose...')}}</option>
              @foreach ($organizations as $item)
              <option value="{{$item->id}}" class="text-dack"> {{$item->name}} </option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="drons_model_id"> {{__('Модель')}} </label>
            <select name="drons_model_id" class="form-control" id="drons_model_id" required="">
              <option >{{__('Choose...')}}</option>
              @foreach ($models as $item)
              <option value="{{$item->id}}" class="text-dack"> {{$item->title}} </option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="id_number"> {{__('Идентификационный номер')}} </label>
            <input autocomplete="off" class="form-control" type="text" name="id_number" id="id_number">
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


<div class="modal fade" id="deleteDrone" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('drones.destroy', $id = 1)}}" method="post" id="delete-drone-form">
        @method('DELETE')
        @csrf
        <div class="modal-header">
          <h1 class="modal-title text-danger fs-5" id="staticBackdropLabel"> {{__('Важно')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <input type="text" hidden   name="id" id="deleteIdDrone">
            <p class="text-danger">
              {{__('Вы и правда хотите удалить это устройства?')}}
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
