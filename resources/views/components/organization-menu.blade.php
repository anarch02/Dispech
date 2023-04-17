    @foreach ($menu as $item)
    <li class="nav-item">
      <a href="{{route($item['route'])}}" class="nav-link text-light @if($item['active']) active @endif" aria-current="page">
        <i class="{{$item['icon']}}"></i>
        {{$item['title']}}
      </a>
    </li>
    @endforeach