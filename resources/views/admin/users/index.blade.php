@extends('layouts.admin')

@section('content')
<h1 class="text-center"> {{__('Список пользователей')}} </h1>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newUser">
  <i class="bi bi-plus-circle"></i> {{__(' Новый пользователь')}}
</button>

<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('Организация')}} </th>
        <th scope="col"> {{__('ФИО')}} </th>
        <th scope="col"> {{__('Номер телефона')}} </th>
        <th scope="col"> {{__('Действия')}} </th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->organization->name}} </td>
            <td> {{$item->name}} </td>
            <td> {{$item->phone_number}} </td>
            <td class="d-flex flex-wrap">
              <a href="{{route('users.edit', $item->id)}}"
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
        @endforeach
    </tbody>
    
</table>
{{ $users->links('pagination::bootstrap-5') }}

<!-- Modal -->
<div class="modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('users.store')}}" method="post" id="add-user-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создания нового поьзователя')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

          <div>
            <label for="title"> {{__('Организация')}} </label>
            {{-- <input class="form-control" type="text" name="title" id="title"> --}}
            {{-- <label for="state" class="form-label">State</label> --}}
            <select name="organization_id" class="form-control" id="organization_id" required="">
              <option >{{__('Выбрать...')}}</option>
              @foreach ($organizations as $item)
              <option value="{{$item->id}}" class="text-dack"> {{$item->name}} </option>
              @endforeach
            </select>
          </div>

            <div>
              <label for="title"> {{__('ФИО')}} </label>
              <input autocomplete="off" class="form-control" type="text" name="name" id="name">
            </div>

            <div>
              <label for="phone_number"> {{__('Номер телефона')}} </label>
              <input autocomplete="off" class="form-control" type="text" name="phone_number" id="phone_number">
            </div>
            
            <div class="mt-2">
              <label for="title"> {{__('E-mail')}} </label>
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
      <form action="{{route('users.destroy', $id = 1)}}" method="post" id="delete-user-form">
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
              {{__('Do you really want delete this user?')}}
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
