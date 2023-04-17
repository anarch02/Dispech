@extends('layouts.admin')

@section('content')
<h2 class="text-center"> {{__('Список моделей устройства')}} </h2>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newModel">
  <i class="bi bi-plus-circle"></i> {{__(' Создать модель')}}
</button>

<table class="table table-striped table-sm mt-3">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Наменования')}} </th>
        <th scope="col"> {{__('Устройства')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>


        @foreach ($models as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->title}} </td>
            <td> {{count($item->drones)}} </td>
            <td class="d-flex flex-wrap">
                <a href="{{route('models.show', $item->id)}}" class="btn bi bi-eye"></a>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>

{{ $models->links('pagination::bootstrap-5') }}



<!-- Modal -->
<div class="modal fade" id="newModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('models.store')}}" method="post" id="add-model-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создать новый модель устройства')}} </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <label for="title"> {{__('Наименования')}} </label>
            <input autocomplete="off" class="form-control" type="text" name="title" id="title">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="submit" class="btn btn-primary">Создать</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="updateModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('models.update', $id = 1 )}}" method="post" id="update-model-form">
        @method('PUT')
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Обновить модель устройства')}} </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessageUpdate"></div>
          <input class="form-control" hidden type="text" name="id" id="up_id">

            <label for="title"> {{__('Наименования')}} </label>
            <input class="form-control title" type="text" name="title" id="up_title">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          <button type="submit" id="update-model-save" class="btn btn-primary"> {{__('Сохранить')}} </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

</script>
@endsection
