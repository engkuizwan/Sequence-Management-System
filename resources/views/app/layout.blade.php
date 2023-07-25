<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEQSYS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/brands.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script> 
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
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/toastr/toastr.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>

    <!-- jquery-validation -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-validation/additional-methods.min.js') }}"></script>


    
{{-- Custom Js --}}
<script src="{{ asset('asset/js/custom.js') }}" type="text/javascript" charset="utf-8"></script>
@yield('script')

@include('modal')
@include('asset.flash-message')















</body>
</html>
