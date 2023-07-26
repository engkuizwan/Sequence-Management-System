@extends('app.layout')

@section('content')
    {{-- <img src="{{asset('asset/dist/img/amtis-logo.png')}}" > --}}
{{-- <div class="login-box"> --}}

    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Register New account</p>

        <form action="{{route('userprofile.store')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{old('name')??($user_detail->name??'')}}" />
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror

            </div>
           
            <div class="form-group">
                <select {{$show??""==1?"disabled":""}} name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" {{$disabled??''}}>
                    <option selected>Choose Role</option>
                    @foreach ($role as $item )
                        <option value="{{$item->role_id}}" >{{$item->role}}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
           
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email" name="user_email" aria-describedby="emailHelp"placeholder="www@gmail.com" value='{{old('user_email')??($user_detail->user_email??'')}}' >
                @error('user_email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
      
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="username" value='{{old('user_name')??($user_detail->user_name??'')}}' >
                @error('user_name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
          
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('user_password') is-invalid @enderror" id="user_password" name="user_password" placeholder="password" value='{{old('user_password')??($user_detail->user_password??'')}}' >
                    @error('user_password')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                   
            </div>
            <button type="submit" class="btn btn-success buttonsaveajax" onclick="insert()">Submit</button>
            <a class="btn btn-primary" href="{{route('index')}}">Back</a>
        </form>
        </div>
        <table class="table table-striped projects">
            <thead>
            <tr>
              <th>Name</th>
              <th>User Name</th>
              <th>Role</th>
              <th>Register Date</th>
              <th style="text-align: center;">Action</th>
            </tr>
            </thead>
            <tbody>
    
            @forelse ($user as $item )
            <tr>
                <td><a href="{{route('show_user_profile',$item->userID)}}">{{$item->name}}</a></td>
                <td>{{$item->user_name}}</td>
                <td>{{$item->role}}</td>
                <td>{{is_int($item->created_at)?  date('d-m-Y',$item->created_at) : date('d-m-Y',strtotime($item->created_at))}}</td>
                <td align="center">
                    {{-- <a href="" class="mr-1 mb-1 btn btn-sm btn-primary">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="" class="mr-1 mb-1 btn btn-sm btn-info">
                      <i class="fas fa-pencil-alt"></i>
                  </a> --}}
                    <form action="{{route('user_remove',$item->userID)}}">
                        {{-- @csrf --}}
                        {{-- @method('delete') --}}
                        {{-- <input type="hidden" name='project_id' value="{{$item->projectID}}"> --}}
                        <button type="susmit" class="mr-1 mb-1 btn btn-sm btn-danger">
                          <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>

            </tr>
            @empty
            <tr>
                <td colspan="3">No Project Assigned</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
     @endsection




