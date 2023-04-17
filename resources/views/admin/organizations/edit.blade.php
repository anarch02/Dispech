@extends('layouts.admin')

@section('content')

<div class="row vertical-items-center">
  <form class="col-ms-6 p-4" action="{{route('organizations.update', $organization->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="modal-header">
      <h1 class="text-center fs-5" id="staticBackdropLabel"> {{__('Обновление ' .$organization->name)}} </h1>
    </div>
    <div>
      <div class="errorsMessage"></div>

      <div>
        <label for="title"> {{__('Наименование')}} </label>
        <input class="form-control" value="{{$organization->name}}" type="text" name="name" id="name">
      </div>

      <div>
        <label for="title"> {{__('Регион')}} </label>
        <select name="region_id" class="form-control" id="region_id" required="">
          @foreach ($regions as $item)
          <option @if($organization->region_id == $item->id) class="bg-primary" selected @endif value="{{$item->id}}" class="text-dack"> {{$item->title}} </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="title"> {{__('Адрес')}} </label>
        <input  class="form-control" value="{{$organization->address}}" type="text" name="address" id="address">
      </div>
    </div>
    
    <div class="row justify-content-between m-3">
      <a href="{{route('organizations.index')}}" class="btn btn-secondary mt-2"> {{__('Назад')}} </a>
      <button type="submit" class="btn btn-primary mt-2"> {{__('Сохранить')}} </button>
    </div>
  </form>
</div>
@endsection
