<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEQSA</title>

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
  

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  @include('app.navbar')

  @include('app.topbar')
  
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                  @yield('page-header')
                  {{-- <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1>Blank Page</h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Blank Page</li>
                          </ol>
                      </div>
                  </div> --}}
              </div><!-- /.container-fluid -->
          </section>

  @include('app.content')

  @include('app.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- Bootstrap 4 -->
<script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('asset/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('asset/dist/js/demo.js') }}"></script>
{{-- Custom Js --}}
<script src="{{ asset('asset/js/custom.js') }}" type="text/javascript" charset="utf-8"></script>
{{-- <script src="{{ asset('asset/js/other.js') }}" type="text/javascript" charset="utf-8"></script> --}}


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
    {{-- <script src="{{ asset('firebase-messaging-sw.js') }}"></script> --}}
    <!-- Toastr -->
@yield('script')

@include('modal')
@include('asset.flash-message')















</body>
</html>
