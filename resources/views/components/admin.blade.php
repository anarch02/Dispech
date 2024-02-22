            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
              <!-- Sidebar - Brand -->
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                  <div class="sidebar-brand-icon rotate-n-15">
                      <i class="fas fa-laugh-wink"></i>
                  </div>
                  <div class="sidebar-brand-text mx-3">Dispech <sup>2</sup></div>
              </a>
  
              <!-- Divider -->
              <hr class="sidebar-divider my-0">
  
              @foreach ($menu as $item)
              <li class="nav-item @if($item['active']) active @endif">
                <a class="nav-link" href="{{route($item['route'])}}">
                    <i class="{{$item['icon']}}"></i>
                    <span>{{$item['title']}}</span></a>
              </li>

              @endforeach
  
              
  
          </ul>
          <!-- End of Sidebar -->
