@extends('layouts.app')

@section('content')
  <form action="{{route('organization.application.store')}}" 
  method="post" id="form" enctype="multipart/form-data">
    @csrf

    <h1 class="text-center"> {{__('Новая заявка')}} </h1>

    @if ($errors)
        @foreach ($errors->all as $item)
            {{$item}}
        @endforeach
    @endif

    <div class="mt-2">
      <table class="table">
        <tbody>
          <tr>
            <td>{{__('Наименование организации')}}</td>
            <td>{{Auth::user()->organization->name}}</td>
            <input type="integer" name="organization_id" hidden value="{{Auth::user()->organization_id}}" >
          </tr>
          <tr>
            <td>{{__('ФИО отправителя ')}}</td>
            <td>{{Auth::user()->name}}</td>
            <input type="integer" hidden name="user_id" value="{{Auth::user()->id}}" >
          </tr>
          <input id="route" data-params='@json(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])' hidden>

          <tr>
            <td>{{__('Номер телефона')}}</td>
            <td>{{Auth::user()->phone_number}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-5">
      <div class="mt-2">
        <label for="drones" class="form-label">{{__('Устройства')}}</label>
        <select id="selectElement" class="@error('drones') border-danger @enderror" name="drones[]" multiple>
          @foreach ($drones as $drone)
            <option value="{{$drone->id}}"> {{$drone->id_number}} </option>    
          @endforeach
        </select>
      </div>

      <div class="mt-2">
        <label for="drones" class="form-label">{{__('Пилоты')}}</label>
        <select id="multiple" class="@error('pilots') border-danger @enderror" name="pilots[]" multiple>
          @foreach ($pilots as $pilot)
            <option value="{{$pilot->id}}"> {{$pilot->name}} </option>    
          @endforeach
        </select>
      </div>
    </div>

    
    <div class="mt-5">
      <h2 class="text-center">
        {{__('More information')}}
      </h2>
    </div>


    
    
    <div class="mb-3" id="map"></div>

    <input type="text" name="lat[]" id="lats" hidden>
    <input type="text" name="lng[]" id="lngs" hidden>
    <input type="text" name="centerLat" id="centerLat" hidden>
    <input type="text" name="centerLng" id="centerLng" hidden>
    <input type="text" name="zoom" id="zoom" hidden>
    {{-- <input type="file" name="file" value="1"> --}}

    <table class="table">
      <tbody>
        <tr>
          <td>{{__('Высота')}}</td>
          <td>

            <div class="input-group mb-3">
              <input type="text"  name="height" 
              id="height" class="form-control @error('height') border-danger @enderror" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2">Метров</span>
            </div>
          </td>
        </tr>

        <tr>
          <td>{{__('Радиус')}}</td>
          <td>
            <div class="input-group mb-3">
              <input type="text" id="radius" name="radius" 
              id="radius" class="form-control @error('radius') border-danger @enderror" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2">Метров</span>
            </div>
          </td>

        </tr>

        <tr>
          <td>{{__('Координаты местности')}}</td>
          <td>
            <input type="text"  name="place" 
            id="place" class="form-control mb-2 @error('place') border-danger @enderror">
          </td>
        </tr>

        <tr>
          <td>{{__('Местность')}}</td>
          <td>
            <input type="text"  name="place" 
            id="place" class="form-control mb-2 @error('place') border-danger @enderror">
          </td>
        </tr>
      </tbody>
    </table>

    <div class="mt-3">
      <h4 class="text">{{__('Период на разрешения')}}</h4>

      <div class="row">
        <div class="col">
          <label for="startDate">{{__('От')}}</label>
          <input type="datetime-local" name="finishDate" class="form-control @error('finishDate') border-danger @enderror" id="finishDate">
        </div>
        <div class="col">
          <label for="startDate">{{__('До')}}</label>
          <input type="datetime-local" name="startDate" class="form-control @error('startDate') border-danger @enderror" id="startDate">
        </div>
      </div>
    </div>

    <div class="form-floating mt-5">
      <textarea name="cause" 
      id="cause" class="form-control @error('cause') border-danger @enderror" style="height: 100px"></textarea>
      <label for="cause">{{__('Причина')}}</label>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    


    <button class="w-100 mt-5 btn btn-primary btn-lg" id="addApplicationBtn" type="submit">{{__('Отправить')}}</button>
  </form>
@endsection
