@extends('app.layout')

@section('content')


<div class="card">
    {{-- <div class="card-header">
      <h3 class="card-title">Projects Detail</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div> --}}
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">

          <div class="row">
            {{-- <div class="col-12 col-sm-4">
              <div class="info-box bg-light">
                <div class="info-box-content">
                  <span class="info-box-text text-center text-muted">Estimated budget</span>
                  <span class="info-box-number text-center text-muted mb-0">2300</span>
                </div>
              </div>
            </div> --}}
            
          </div>
          <div class="row">
            {{-- <div class="col-12 col-sm-4"> --}}
                
                  @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
                  <button class="btn btn-dark float-right mb-2" onclick="addmembers({{$project_id}})">Add Members</button>            
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
                        <form action="{{ route('remove_member2',) }}" method="post">
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
                <!-- /.card-body -->
              {{-- <div class="d-flex justify-content-end mt-2"> --}}
                {{ $members->links() }}
            {{-- </div> --}}
            {{-- </div> --}}
        

          </div>

          <div class="row">
            {{-- <div class="col-12">
              <h4>Recent Activity</h4>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                    <span class="username">
                      <a href="#">Jonathan Burke Jr.</a>
                    </span>
                    <span class="description">Shared publicly - 7:45 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore.
                  </p>

                  <p>
                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                  </p>
                </div>

                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                    <span class="username">
                      <a href="#">Sarah Ross</a>
                    </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore.
                  </p>
                  <p>
                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                  </p>
                </div>

                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                    <span class="username">
                      <a href="#">Jonathan Burke Jr.</a>
                    </span>
                    <span class="description">Shared publicly - 5 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore.
                  </p>

                  <p>
                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v1</a>
                  </p>
                </div>
            </div> --}}
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
            {{-- <div class="project-actions"> --}}
                <h3 class="d-inline text-primary">{{$project->project_name}}</h3>
                <a type="button" href="{{route('update_project_status', $project->projectID)}}"><span class="d-inline badge badge-{{$project->status == 'PS01'?'warning':'success'}}" style="margin-bottom: 2px; margin-left: 2px;" >{{$project->status == 'PS01'?'On-Going':'Completed'}}</span></a>
                
            {{-- </div> --}}
          
          <br>
          <div class="text-muted">
            <p class="text-sm">Client Company
              <b class="d-block">{{$project->client_company}}</b>
            </p>
            <p class="text-sm">Project Leader
              <b class="d-block">{{$project->name}}</b>
            </p>
          </div>

          <h5 class="mt-3 text-muted">Project Description</h5>
          <p class="text-muted">{{$project->project_description}}</p>

          <div class="text-right">
            {{-- <a href="#" class="btn btn-sm btn-primary">Add files</a>
            <a href="#" class="btn btn-sm btn-warning">Report contact</a> --}}
            @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
                      <a onclick="show({{$project->projectID}})" class="btn btn-info btn-sm">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>


  @endsection


  {{-- @section('script') --}}
  <script>
    // $(document).ready(function(){
    // });
    
    function show(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('project_edit_all') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Update Project');
        });
      }

      
      function addmembers(project_id){
        // alert(project_id);
        $.get("{{ url('assign_project_form2') }}/"+project_id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Assign New Member');
          $('#project_id').val(project_id); //to set value
        });
      }
  </script>
  {{-- @endsection --}}