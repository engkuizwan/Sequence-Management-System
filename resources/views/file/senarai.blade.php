@extends('app.layout')

@section('content')


    
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Files</h3>
    </div>
    <div class="card-body">
      @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
      <button class="btn btn-success float-right" onclick="createfile({{$project_id}})">Add New File</button>
      @endif
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>File Name </th>
          <th>File Type</th>
          <th>Created At</th>
          <th style="text-align: center;">Action</th>
        </tr>
        </thead>
        <tbody>

        @forelse ($file as $item )
        <tr>
          <td><a href="{{ route('functionindex', ['fileId' => encrypt($item->file_ID), 'e_project_id' => $e_project_id]) }}">{{$item->file_name}}</a></td>
          <td>{{$item->file_type}}</td>
          <td>{{ is_int($item->created_at)?  date('d-m-Y',$item->created_at) : date('d-m-Y',strtotime($item->created_at)) }}</td>
          <td align="center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <button onclick="showfile({{$item->file_ID}})" class="btn btn-dark btn-sm">
                  <i class="fas fa-eye"></i>
                </button>
              </li>

              @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
              <li class="list-inline-item">
                <button onclick="editfile({{$item->file_ID}})" class="btn btn-info btn-sm">
                  <i class="fas fa-pencil-alt"></i>
                </button>
              </li>
              @endif

              
              @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
              <li class="list-inline-item">
                <form action="{{ route('file.destroy', $item->file_ID) }}" method="post">
                  @csrf
                  @method('delete')
                  <input type="hidden" name='project_id' value="{{$item->projectID}}">
                    <a type="submit" class="btn btn-danger btn-sm buttonsaveajax" data-message2='This file will be deleted'>
                      <i class="fas fa-trash"></i>
                    </a>
                </form>
              </li>
              @endif

            </ul>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" align="center">No File Inserted</td>
        </tr>
        @endforelse

        </tbody>
        {{-- <tfoot>
        <tr>
          <th>Rendering engine</th>
          <th>Browser</th>
          <th>Platform(s)</th>
          <th>Engine version</th>
          <th>CSS grade</th>
        </tr>
        </tfoot> --}}
      </table>
    </div>
    <!-- /.card-body -->
    <div class="d-flex justify-content-end mt-2">
      {{ $file->links() }}
  </div>

  </div>
    

    <script>
      $(function () {

        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false, 
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "pagelength":2,
          'order': []
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#example2").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false, 
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "pagelength":2,
          'order': []
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

      });

      function createfile(project_id){
        $.get("{{ route('file.create') }}", {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Create File');
          $('#project_id').val(project_id); //to set value
        });
      }

  

      function createmodul(project_id){
        $.get("{{ route('modul.create') }}", {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Create Modul');
          $('#project_id').val(project_id); //to set value
        });
      }
      function editmodul(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('modul_edit') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Update Modul');
        });
      }
      function editfile(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('file_edit') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Update File');
        });
      }

      function showfile(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('file_show') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Update File');
        });
      }

      function showmodul(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('modul_show') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Update File');
        });
      }

      function addmembers(project_id){
        // alert(project_id);
        $.get("{{ url('assign_project_form') }}/"+project_id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Assign New Member');
          $('#project_id').val(project_id); //to set value
        });
      }

      

    </script>

@endsection

