@extends('layouts.admin')

@section('content')
<h1 class="text-center"> {{__('Список регонов')}} </h1>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newRegion">
  <i class="bi bi-plus-circle"></i>{{__(' Новый регион')}}
</button>
<table class="table table-striped table-sm mt-3">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Наименования')}} </th>
        <th scope="col"> {{__('Организации')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($regions as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->title}} </td>
            <td> {{count($item->organizations)}} </td>
            <td>
                <button 
                  data-bs-toggle="modal"
                  data-bs-target="#updateRegion"
                  data-id="{{$item->id}}"
                  data-title="{{$item->title}}"
                  id="update-region-button"
                  class="btn">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" 
                data-bs-toggle="modal"
                data-bs-target="#deleteRegion"
                id="delete-region-button" 
                data-id="{{$item->id}}"
                class="btn">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
{{ $regions->links('pagination::bootstrap-5') }}



<!-- Modal -->
<div class="modal fade" id="newRegion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('regions.store')}}" method="post" id="add-region-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создать новый регион')}} </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <label for="title"> {{__('Наименования')}} </label>
            <input autocomplete="off" class="form-control" type="text" name="title" id="title">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="updateRegion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('regions.update', $id = 1)}}" method="post" id="update-region-form">
        @method('PUT')
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Обновить регион')}} </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>
          <input class="form-control" hidden type="text" name="id" id="up_id">
            <label for="title"> {{__('Наименования')}} </label>
            <input class="form-control title" type="text" name="title" id="up_title">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="submit" id="update-region-save" class="btn btn-primary"> {{__('Сохранить')}} </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteRegion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('regions.destroy', $id = 1)}}" method="post" id="delete-region-form">
        @method('DELETE')
        @csrf
        <div class="modal-header">
          <h1 class="modal-title text-danger fs-5" id="staticBackdropLabel"> {{__('Важно')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <input type="text" hidden name="id" id="deleteIdRegion">
            <p class="text-danger">
              {{__('Вы и правда хотите удалить этот регион?')}}
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
