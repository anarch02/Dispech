@extends('layouts.app')

@section('content')
<h1 class="text-center"> {{__('Список')}} </h1>

{{-- <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#newUser">
  <i class="bi bi-plus-circle"></i> {{__(' Новый пользователь')}}
</button> --}}

<table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col"> {{__('ФИО')}} </th>
        <th scope="col"> {{__('Номер телефона')}} </th>
        {{-- <th scope="col"> {{__('Действия')}} </th> --}}
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
        <tr>
            <td> {{$loop->iteration}} </td>
            <td> {{$item->name}} </td>
            <td> {{$item->phone_number}} </td>
            {{-- <td class="d-flex flex-wrap">
              <a href="{{route('users.edit', $item->id)}}"
                class="btn">
                <i class="bi bi-pencil-square"></i>
              </a>
            </td> --}}
          </tr>
        @endforeach
    </tbody>
    
</table>

<!-- Modal -->
<div class="modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">
      <form action="{{route('users.store')}}" method="post" id="add-user-form">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Создать нового пользователя')}} </h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="errorsMessage"></div>

          <div>
            <label for="title"> {{__('Organization')}} </label>
            
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
              <label for="title"> {{__('Логин')}} </label>
              <input autocomplete="off" class="form-control" type="text" name="login" id="login">
            </div>

            <div>
              <label for="title"> {{__('Пароль')}} </label>
              <input autocomplete="off" class="form-control" type="password" name="password" id="password">
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
