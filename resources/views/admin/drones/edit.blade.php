@extends('layouts.admin')

@section('content')

<form action="{{route('drones.update', $drone->id)}}" method="post">
  @method('PUT')
  @csrf
  <div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Обновить '. $drone->id_number)}} </h1>
  </div>
  <div class="modal-body">

    <div>
      <label for="title"> {{__('Организация')}} </label>
      <select name="organization_id" class="form-control @error('organization_id') border-danger @enderror" id="organization_id" required="">
        <option >{{__('Choose...')}}</option>
        @foreach ($organizations as $item)
        <option value="{{$item->id}}" @if($drone->organization_id == $item->id) class="bg-primary" selected @endif class="text-dack"> {{$item->name}} </option>
        @endforeach
      </select>
    </div>

    <div>
      <label for="drons_model_id"> {{__('Модель')}} </label>
      <select name="drons_model_id" class="form-control @error('drons_model_id') border-danger @enderror" id="drons_model_id" required="">
        <option >{{__('Choose...')}}</option>
        @foreach ($models as $item)
        <option value="{{$item->id}}" @if($drone->drons_model_id == $item->id) class="bg-primary" selected @endif class="text-dack"> {{$item->title}} </option>
        @endforeach
      </select>
    </div>

    <div>
      <label for="id_number"> {{__('Идентификационный номер')}} </label>
      <input autocomplete="off" class="form-control @error('id_number') border-danger @enderror" value="{{$drone->id_number}}" type="text" name="id_number" id="id_number">
    </div>
    
    <div class="row">
      <div class="col">
        <a href="{{route('drones.index')}}" class="btn w-100 btn-secondary mt-2"> {{__('Назад')}} </a>
      </div>
      <div class="col">
        <button type="submit" class="btn w-100 btn-primary mt-2"> {{__('Сохранить')}} </button>
      </div>
    </div>
  </div>
</form>

@endsection
