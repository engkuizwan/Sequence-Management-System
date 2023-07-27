@extends('app.layout')

@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Function</h3>
    </div>
<div class="card-body">
    {{-- <button class="btn btn-success float-right" onclick="createfile({{$file_id}})">Add New Function</button> --}}
    <a href="{{ route("functioncreate", ['file_id' => encrypt($file_id), 'e_project_id' => $e_project_id]) }}" class="btn btn-success float-right">Add New Function</a>
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Function Name</th>
                    <th>Function Description</th>
                    <th>Creator</th>
                    <th>Created At</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($functionList as $item)
                    <tr>
                        <td>{{$item->function_name}}</td>
                        <td>{{$item->functionDesc}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{is_int($item->created_at)?  date('d-m-Y',$item->created_at) : date('d-m-Y',strtotime($item->created_at))}}</td>
                        <td align="center">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route('functionShow', ['functionId' => $item->functionID, 'e_project_id' => $e_project_id]) }}" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>
                                </li>
                  
                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
                                <li class="list-inline-item">
                                    <a href="{{ route('functionEdit', ['functionId' => $item->functionID, 'e_project_id' => $e_project_id]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </li>
                                @endif
                  
                                
                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
                                <li class="list-inline-item">
                                    <form action="{{ route('function.destroy', $item->functionID) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='file_id' value="{{$file_id}}">
                                        <input type="hidden" name='e_project_id' value="{{$e_project_id}}">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </li>
                                @endif
                  
                              </ul>
                        </td>
                    </tr>
                    @empty
                    <tr align="center">
                        <td colspan="5"> No Function Inserted </td>
                    </tr>
                    @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-2">
          {{ $functionList->links() }}
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
    let reg = null;
    
    navigator.serviceWorker.register('./firebase-messaging-sw.js')
    .then((registration) => {
        messaging.useServiceWorker(registration);

        reg = registration;
        // console.log(reg);
    });

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        // new  Notification(noteTitle, noteOptions);
        reg.showNotification(noteTitle, noteOptions);
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
                // alert(token);
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