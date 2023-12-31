
{{-- @php
    use App\Models\MasterGrantMonitoring;
@endphp --}}
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
      
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
      
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button">
          <i class="fas fa-sign-out-alt"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </ul> 
    
  </li>
  </nav>
  <!-- /.navbar -->

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
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="{{route('profile')}}"  class="nav-link {{Route::currentRouteName()=='profile'?'active':''}}" style="background-color: {{Route::currentRouteName()=='profile'?'#001f3f':''}} ">
                  {{auth()->user()->user_name}}
                  <br><small style="color: #ffffff">{{auth()->user()->role->role}}</small>
                </a>
              </li>
            </ul>
          </nav>
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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

          {{-- <li class="nav-item">
            <a href="{{route('project.admin')}}" class="nav-link">
              <i class="fa fa-briefcase" style="color: #ffffff;"></i>
              <p>PROJECT</p>
            </a>
          </li> --}}

          {{-- ************************************** --}}

          {{-- <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">
              <i class="fa fa-users" aria-hidden="true" style="color: #ffffff;"></i>
              <p>TEAM</p>
            </a>
          </li> --}}




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>