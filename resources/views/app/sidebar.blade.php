  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('project.admin')}}" class="brand-link">
      <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('asset/dist/img/seqsys-logo.png') }}" alt="AdminLTE Logo" class="" >
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel pb-3 mb-3 d-flex">
        <div class="info">
                <a href="{{route('profile')}}"  class="nav-link {{Route::currentRouteName()=='profile'?'active':''}}" style="background-color: {{Route::currentRouteName()=='profile'?'#001f3f':''}} ">
                  {{auth()->user()->user_name}}
                  <br><small style="color: #ffffff">{{auth()->user()->role->role}}</small>
                </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

           {{-- LIST SIDE NAVIGATION --}}
           @foreach ($list_navbar as $ln )
            <li class="nav-item">
              <a href="{{route($ln->route,($ln->require_id == 1?$e_project_id:null))}}" class="nav-link {{Route::currentRouteName()==$ln->route?'active':''}}" style="background-color: {{Route::currentRouteName()==$ln->route?'#001f3f':''}} ">
                {{-- {{$e_project_id}} --}}
                <i class="{{$ln->class_icon}}" style="color: #ffffff;"></i>
                <p>{{$ln->name}}</p>
                {{-- <p>{{Route::currentRouteName()}}</p>
                <p>{{$ln->route}}</p> --}}
              </a>
            </li>
           @endforeach

           @if (session('role') == 'Admin')
           <li class="nav-item">
             <a href="{{route('userprofile.create')}}" class="nav-link {{Route::currentRouteName()=='userprofile.create'?'active':''}}" style="background-color: {{Route::currentRouteName()=='userprofile.create'?'#001f3f':''}} " >
               {{-- {{$e_project_id}} --}}
               <i class="fas fa-cash-register" style="color: #ffffff;"></i>
               <p>Register New User</p>
             </a>
           </li>
           @endif




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>