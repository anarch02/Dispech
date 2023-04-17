@extends('layouts.admin')

@section('content')
<h1 class="text-center"> {{__('Список администраторов')}} </h1>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newUser">
  <i class="bi bi-plus-circle"></i> {{__(' Новый администратор')}}
</button>

@if (Session::has('message'))
    <div class="alert alert-danger">
      {{$message}}
    </div>
@endif

<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('ФИО')}} </th>
        <th scope="col"> {{__('Номер телефона')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($admins as $item)
        @if ($item->isSuperAdmin == false)
        <tr>
          <td> {{$loop->iteration}} </td>
          <td> {{$item->name}} </td>
          <td> {{$item->phone_number}} </td>
          <td class="d-flex flex-wrap">
            <a href="{{route('admins.edit', $item->id)}}"
              class="btn">
              <i class="bi bi-pencil-square"></i>
            </a>

            <button 
              data-bs-toggle="modal"
              data-bs-target="#deleteUser"
              data-id="{{$item->id}}"
              id="delete-user-button"
              class="btn">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
        @endif
          
        @endforeach
    </tbody>
    
</table>
{{ $admins->links('pagination::bootstrap-5') }}

<!-- Modal -->
<div class="modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('admins.store')}}" method="post" id="add-user-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создания нового пользователя')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <div>
              <label for="title"> {{__('ФИО')}} </label>
              <input autocomplete="off" class="form-control" type="text" name="name" id="name">
            </div>

            <div>
              <label for="phone_number"> {{__('Номер телефона')}} </label>
              <input autocomplete="off" class="form-control" type="text" name="phone_number" id="phone_number">
            </div>

            <div class="mt-2">
              <label for="login"> {{__('Логин')}} </label>
              <input autocomplete="off" class="form-control" type="text" name="login" id="login">
            </div>

            <div>
              <label for="title"> {{__('Пароль')}} </label>
              <input autocomplete="off" class="form-control" type="password" name="password" id="password">
            </div>

            <div>
              <label for="title"> {{__('Потвердите пароль')}} </label>
              <input autocomplete="off" id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
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


<div class="modal fade" id="deleteUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('admins.destroy', $id = 1)}}" method="post" id="delete-user-form">
        @method('DELETE')
        @csrf
        <div class="modal-header">
          <h1 class="modal-title text-danger fs-5" id="staticBackdropLabel"> {{__('Warning')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

            <input type="text" hidden name="id" id="deleteIdUser">
            <p class="text-danger">
              {{__('Вы действительно хотите удалить этого администратора?')}}
            </p>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{__('Close')}} </button>
          <button type="submit" class="btn btn-danger"> {{__('Delete')}} </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
