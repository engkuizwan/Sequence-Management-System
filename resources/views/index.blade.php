
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SEQSYS | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/brands.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('asset/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/sweetalert2/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylrsheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('asset/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('asset/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('asset/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/toastr/toastr.min.css') }}">
<style>
img {
  max-width: 30%;
  height: auto;
}
</style>

</head>

<body class="hold-transition login-page">
    <img src="{{asset('asset/dist/img/amtis-logo.png')}}" >
<div class="login-box">

    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{route('login')}}" method="post">
                @csrf

                <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" name="user_name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="user_password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                            Remember Me
                            </label>
                        </div>
                    </div>
                    --}}

                <div >
                    <button type="submit" class="btn btn-primary btn-block" style="min-width: 100%">Sign In</button>
                </div>

                </div>
            </form>


            <p class="mb-1">
            {{-- <a href="forgot-password.html">I forgot my password</a> --}}
            </p>

            <p class="mb-1">
                {{-- <a type="submit" href="{{route('userprofile.create')}}">Register account</a> --}}
            </p>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
    {{-- SweetAlert2 --}}
    <script src="{{ asset('asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
@include('asset.flash-message')
</body>
</html>

