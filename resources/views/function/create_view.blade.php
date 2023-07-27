@extends('app.layout')

@section('content')
@if ($funcDetail == null)
        <form action="{{route('store_view')}}" method="post">
            @csrf
            @include('function._form_view')

            <input type="hidden" name="e_project_id" value="{{$e_project_id}}">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
@else
        <form action="{{route('update_view')}}" method="post">
            @csrf
            @include('function._form_view')
            <input type="hidden" name="function_id" value="{{$funcDetail->functionID}}">
            <input type="hidden" name="e_project_id" value="{{$e_project_id}}">
            <div class="text-center">
                <button type="submit" class="btn btn-info">Update</button>
            </div>

        </form>
@endif
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