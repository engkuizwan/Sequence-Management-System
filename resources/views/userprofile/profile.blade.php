@extends('app.layout')
@section('page-header')
    <h1 class=" mb-2 text-gray-800">User Profile</h1>
@endsection
@section('content')
<div class="row mt-1">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info shadow mb-4" style="min-height: 100%;">
                    <div class="card-header" style="background-color: #001f3f">
                        <h3 class="card-title">PROFILE</h3>
                    </div>
                    <div class="card-body">
                        
                    <div>
                        <div style="min-width: 100%" class="mb-4">
                            <span class="badge badge-{{$user->status == 1?'success':'danger'}}" style="margin-left: 55%" >{{$user->status == 1?'Active':'Resigned'}}</span>
                            <div class="text-center mb-1">
                                <div class="image">
                                    <img src="{{ asset('AdminLTE-3.2.0/dist/img/user-default-160x160.png') }}" class="img-circle elevation-2" alt="User Image">
                                </div>
                            </div>
                        </div>
                    </div>
                        {{-- <div class="card"> --}}
                            {{-- <div class="card-body"> --}}
                                {{-- <div class="form-group row">
                                    <b class="px-3">PROFIL DIRI</b>
                                </div>
                                <br> --}}
                                <form action="{{route('update_user',$user)}}" method="post">
                                    @csrf

                                  
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label class="control-label col-md-3"><b>Name</b></label>
                                    <label class="col-sm-1 control-label">:</label>
                                    <input type="text" name="name" value="{{$user->name}}"class="form-control control-label col-md-7">
                                    {{-- <label class="control-label col-md-7 text-secondary"><b>{{ $user->name }}</b></label> --}}
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label class="control-label col-md-3"><b>User Name</b></label>
                                    <label class="col-sm-1 control-label">:</label>
                                    <input type="text" name="user_name" value="{{$user->user_name}}"class="form-control control-label col-md-7">
                                    {{-- <label class="control-label col-md-7 text-secondary"><b>{{ $user->name }}</b></label> --}}
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label class="control-label col-md-3"><b>Emel</b></label>
                                    <label class="col-sm-1 control-label">:</label>
                                    <input type="text" name="user_email" value="{{$user->user_email}}"class="form-control control-label col-md-7">
                                    {{-- <label class="control-label col-md-7 text-secondary"><b>{{ $user->user_email }}</b></label> --}}
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label class="control-label col-md-3"><b>Role</b></label>
                                    <label class="col-sm-1 control-label">:</label>
                                    {{-- <input type="text" name="role" value="{{$role->role}}"class="form-control control-label col-md-7"> --}}
                                    <label class="control-label col-md-7 text-secondary"><b>{{  $role }}</b></label>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label class="control-label col-md-3"><b>Password</b></label>
                                    <label class="col-sm-1 control-label">:</label>
                                    <input type="text" name="user_password" class="form-control control-label col-md-7">
                                    {{-- <label class="control-label col-md-7 text-secondary"><b>{{ $role }}</b></label> --}}
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7">

                                    </div>
                                    <div class="col-md-5">
                                        <ul class="list-inline">

                                            <li class="list-inline-item">
                                                <button style="margin-left: 20px;"  type="submit" class="btn btn-warning btn-sm buttonsaveajax ">Update</button>
                                            </li>
                                            <li class="list-inline-item">
                                                <a onclick="initFirebaseMessagingRegistration()"  type="submit" class="btn btn-info btn-sm "><i class="fas fa-coins"></i></a>
                                            </li>
                                        </form>
                                            <li class="list-inline-item">
                                                <form action="{{route('send.notification')}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info btn-sm buttonsaveajax2 ">Test Notification</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6" >
        <div class="card card-info shadow mb-4" style="min-height: 100%;">
            <div class="card-header" style="background-color: #001f3f">
                <h3 class="card-title">PROJECT INVOLVED</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Framework</th>
                      <th>Status</th>
                      <th>Date Assigned</th>
                      {{-- <th style="text-align: center;">Action</th> --}}
                    </tr>
                    </thead>
                    <tbody>
            
                    @forelse ($project as $item )
                    <tr>
                        <td>{{$item->project_name}}</td>
                        <td>{{$item->project_framework}}</td>
                        @foreach ($project_status as $ps )
                            @if ($item->status == $ps->code)
                            <td><span class="badge badge-{{$item->status=='PS01'?'warning':'success'}}">{{$ps->name}}</span></td>                       
                            @endif
                        @endforeach
                        <td>{{is_int($item->created_at)?  date('d-m-Y',$item->created_at) : date('d-m-Y',strtotime($item->created_at))}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" align="center"><b><i>No Project Assigned</i></b></td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script>
     var firebaseConfig = {
    apiKey: "AIzaSyBbigY7kCCqmeAFRlSd61gKAbSK3ZLrfh8",
    authDomain: "testfcm-f527f.firebaseapp.com",
    projectId: "testfcm-f527f",
    storageBucket: "testfcm-f527f.appspot.com",
    messagingSenderId: "1037124914195",
    appId: "1:1037124914195:web:c7d39eaa651ab3dc91c3e6",
    measurementId: "G-ZRVJLDJB9Y"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new  Notification(noteTitle, noteOptions);
    });
    // var dt = document.getElementById("device_token");
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
                alert(token);
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });

                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'new_token': token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        Swal.fire(
                            'Successfull',
                            'Device token registred',
                            'success'
                        );
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });


            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }

</script>
@endsection