@extends('app.layout')

@section('content')

<form action="{{ route('function.update', $funcDetail->functionID) }}" method="POST">
    @csrf
    @method('put');

    <div class="text-center" style="margin-left:45%; margin-bottom:10px;">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    <input type="hidden" name="e_project_id" value="{{$e_project_id}}">
    @include('function._form')

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-primary" href="javascript:history.go(-1)">Cancel</a>
    </div>
</form>
    
@endsection

@section('script')
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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
        new Notification(noteTitle, noteOptions);
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
                // console.log('User Chat Token Error'+ err);
            });
     }

</script>
@endsection