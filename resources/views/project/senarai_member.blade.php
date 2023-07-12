@extends('app.layout')

@section('content')
<style>
  #centered-div {
    display: flex;
    justify-content: center;
  }
  .card {
    width: 100%;
    max-width: 50%;
  }
</style>
    <div id="centered-div">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Members</h3>
        </div>
        <div class="card-body">
          @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
          <button class="btn btn-success float-right" onclick="addmembers({{$project_id}})">Add Members</button>            
          @endif
          <table id="" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Name</th>
              <th>Role</th>
              @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
              <th style="text-align: center;">Action</th>
              @endif
            </tr>
            </thead>
            <tbody>
  
            @forelse ($members as $item )
            <tr>
              <td>{{$item->name}}</td>
              <td>{{$item->role}}</td>
              @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
              <td align="center">
                <form action="{{ route('remove_member',) }}" method="post">
                  @csrf
                  <input type="hidden" name="project_id" value="{{$project_id}}">
                  <input type="hidden" name="user_id" value="{{$item->userID}}">
                  <a class="btn btn-danger btn-sm buttonsaveajax" type="submit"><i class="fas fa-trash"></i> </a>
              </form>
              </td>
              @endif
            </tr>
            @empty
            <tr>
              <td colspan="2" align="center">No Member Assigned</td>
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
        {{ $members->links() }}
    </div>
  
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

