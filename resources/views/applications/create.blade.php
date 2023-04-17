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

          <tr>
            <td>{{__('Устройства')}}</td>
            <td>
              <div class="dropdown mt-2">
                <select id="selectElement" class="@error('drones') border-danger @enderror" name="drones[]" multiple>
                  @foreach ($drones as $drone)
                    <option value="{{$drone->id}}"> {{$drone->id_number}} </option>    
                  @endforeach
                </select>
              </div>
            </td>
          </tr>

          <tr>
            <td>{{__('Пилоты')}}</td>
            <td>
              <div class="dropdown mt-2">
                <select id="multiple" class="@error('pilots') border-danger @enderror" name="pilots[]" multiple>
                  @foreach ($pilots as $pilot)
                    <option value="{{$pilot->id}}"> {{$pilot->name}} </option>    
                  @endforeach
                </select>
              </div>
            </td>
          </tr>

          <tr>
            <td>{{__('Высота')}}</td>
            <td>
              <input type="text"  name="height" 
              id="height" class="form-control mb-2 @error('height') border-danger @enderror">
            </td>
          </tr>

          <tr>
            <td>{{__('Радиус')}}</td>
            <td>
              <input type="text" id="radius" name="radius" 
              id="radius" class="form-control mb-2 @error('radius') border-danger @enderror">
            </td>
          </tr>

          <tr>
            <td>{{__('Местность')}}</td>
            <td>
              <input type="text"  name="place" 
              id="place" class="form-control mb-2 @error('place') border-danger @enderror">
            </td>
          </tr>

          <tr>
            <td>{{__('Причина')}}</td>
            <td>
              <input type="text"  name="cause" 
              id="cause" class="form-control mb-2 @error('cause') border-danger @enderror">
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    
    <div class="mt-2">
      <h4 class="text-center">
        {{__('More information')}}
      </h4>
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
          <td>
            <label for="startDate">{{__('С')}}</label>
            <input type="datetime-local" name="startDate" class="form-control @error('startDate') border-danger @enderror" id="startDate">
          </td>
          <td>
            <label for="startDate">{{__('По')}}</label>
            <input type="datetime-local" name="finishDate" class="form-control @error('finishDate') border-danger @enderror" id="finishDate">
          </td>
        </tr>
      </tbody>
    </table>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    


    <button class="w-100 btn btn-primary btn-lg" id="addApplicationBtn" type="submit">{{__('Отправить')}}</button>
  </form>
@endsection
