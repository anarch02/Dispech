@extends('layouts.app')

@section('content')
  <div>

    <h1 class="text-center"> {{ __('Заявка ID: ') .$application->id}} </h1>

    <div class="mt-2">
      <table class="table">
        <tbody>
          <tr>
            <td>{{__('Организация')}}</td>
            <td>{{$application->organization->name}}</td>
            {{-- <input type="integer" name="organization_id" hidden value="{{}}" > --}}
          </tr>
          <tr>
            <td>{{__('ФИО отправителя')}}</td>
            <td>{{$application->user->name}}</td>
            <input type="integer" hidden name="user_id" value="{{Auth::user()->id}}" >
          </tr>

          <tr>
            <td>{{__('Контактный номер отправителя')}}</td>
            <td>{{$application->user->phone_number}}</td>
          </tr>

          <tr>
            <td>{{__('Устройства')}}</td>
            <td>
              @foreach ($application->drones as $item)
                  {{$item->id_number}} <br>
              @endforeach
            </td>
          </tr>

          <tr>
            <td>{{__('Пилоты')}}</td>
            <td>
              @foreach ($application->users as $item)
                  {{$item->name}} <br>
              @endforeach
            </td>
          </tr>

          <tr>
            <td>{{__('Высота')}}</td>
            <td>
              {{$application->height}}
            </td>
          </tr>

          <tr>
            <td>{{__('Причина')}}</td>
            <td>
              {{$application->cause}}
            </td>
          </tr>

          @if ($application->comment)
            <tr>
              <td>{{__('Причина отказа')}}</td>
              <td>
                {{$application->comment}}
              </td>
            </tr>
          @endif
          

        </tbody>
      </table>
    </div>
    
    
    <div class="mt-2">
      <h4 class="text-center">
        {{__('More information')}}
      </h4>
    </div>

    <input id="cordinates" data-params='@json($application->coordinates)' hidden>
    
    
    <div class="mb-3" id="map"></div>

    @if(auth('admin')->check() && $application->status == false && $application->comment == null)
    <div class="row mt-5">
      <div class="col">
        <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectFrom">
          <i class="bi bi-x-circle"></i>
        </button>
      </div>

      <div class="col">
        <form action="{{route('admin.application.status', $application->id)}}" method="post">
          @csrf
          <input type="checkbox" name="allow" checked hidden id="allow">
          <button type="submit" class="btn btn-success w-100">
            <i class="bi bi-check-circle"></i>
          </button>
        </form>
        
      </div>
    </div>
    @endif
    


  </div>

  <div class="modal fade" id="rejectFrom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
  
      <div class="modal-content">
        <form action="{{route('admin.application.status', $application->id)}}" method="post" id="application-status-update">
          {{-- @method('PUT') --}}
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel"> {{__('Reject request')}} </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          {{-- <input type="checkbox" name="allow"  id="allow"> --}}

          <div class="modal-body">
            <textarea name="comment"id="comment" cols="20" rows="5" class="form-control"></textarea>
          </div>
          
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-send"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
