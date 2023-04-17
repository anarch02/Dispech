@extends('layouts.admin')

@section('content')

<form action="{{route('users.update', $user->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="modal-header">
      <h1 class="text-center fs-5" id="staticBackdropLabel"> {{__('Изменить '.$user->name)}} </h1>
    </div>
    <div class="modal-body">

      <div class="form-group">
        <label class="form-label"> {{__('Организация')}} <span class="text-red">*</span></label>
        <select name="organization_id" class="form-control @error('organization_id') is-invalid @enderror  form-select select2" data-bs-placeholder="Select">
            @foreach($organizations as $item)
            <option @if($user->organization_id == $item->id) class="bg-primary" selected @endif value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        @error('drones_model_id')
        <div class="alert alert-danger mt-3">
            {{$message}}
        </div>
        @enderror
    </div>

        <div>
          <label for="title"> {{__('ФИО')}} </label>
          <input class="form-control" value="{{$user->name}}" type="text" name="name" id="name">
        </div>

        <div>
          <label for="phone_number"> {{__('Номер телефона')}} </label>
          <input class="form-control @error('phone_number') is-invalid @enderror " value="{{$user->phone_number}}" type="text" name="phone_number" id="phone_number">
        </div>

        <div class="mt-2">
          <label> {{__('Роли: ')}} </label>

          <div class="form-check">
            <label class="form-check-label" for="isOrganizationSuperAdmin">
              {{__('Super admin')}}
            </label>
            <input class="form-check-input"  
            type="checkbox" 
            name="isOrganizationSuperAdmin" 
            @if ($user->isOrganizationSuperAdmin)
                checked
            @endif>
          </div>

          <div class="form-check">
            <label class="form-check-label" for="isOrganizationAdmin">
              {{__('Admin')}}
            </label>
            <input class="form-check-input" 
            type="checkbox" 
            name="isOrganizationAdmin" 
            @if ($user->isOrganizationAdmin)
                checked
            @endif>
          </div>

          <div class="form-check">
            <label class="form-check-label" for="isOrganizationPilot">
              {{__('Pilot')}}
            </label>
            <input class="form-check-input" 
            type="checkbox" 
            name="isOrganizationPilot" 
            @if ($user->isOrganizationPilot)
                checked
            @endif>
          </div>
        </div>

        <div class="mt-2">
          <label for="title"> {{__('E-mail')}} </label>
          <input class="form-control @error('email') is-invalid @enderror " value="{{$user->email}}" type="email" name="email" id="email">
        </div>

        <div>
          <label for="title"> {{__('Пароль')}} </label>
          <input class="@error('password') is-invalid @enderror form-control" type="password" name="password" id="password" autocomplete="new-password">
        </div>

        <div>
          <label for="title"> {{__('Потвердите пароль')}} </label>
          <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
        </div>
      
    </div>
    <div class="row justify-content-between">
      <a href="{{route('users.index')}}" class="btn btn-secondary mt-2"> {{__('Назад')}} </a>
      <button type="submit" class="btn btn-primary mt-2"> {{__('Сохранить')}} </button>
    </div>
  </form>

@endsection
