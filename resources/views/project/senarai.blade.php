
{{-- SweetAlert2 --}}
<script src="{{ asset('asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- Custom Js --}}
<script src="{{ asset('asset/js/custom.js') }}" type="text/javascript" charset="utf-8"></script>


    

    
    <!-- Button trigger modal -->
                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
                    <div>
                      <button class="btn btn-success" onClick="create()" style="float:right; margin-bottom:10px;">Add new project</button>
                    </div>
                    @endif


<!-- Default box -->
<div class="card" style="width: 100%;">
  <div class="card-body p-0">
    <table id="example1" class="table table-striped projects">
        <thead>
            <tr>
              <th style="width:20%;">Project Name</th>
              <th style="width:20%;">Framework</th>
              <th style="width:20%;">Project Description</th>
              <th style="text-align: center;width:20%;">Status</th>
              <th style="text-align: center;width:20%;">Action</th>
            </tr>
        </thead>
        <tbody>
          @forelse ( $model as $project )
            <tr>
                <td>
                    <a href="{{ route('modulindex', encrypt($project->projectID)) }}">
                      {{ $project->project_name }}
                    </a>
                    <br/>
                      <small class="text-muted">Created at :  {{is_int($project->created_at)?  date('d-m-Y',$project->created_at) : date('d-m-Y',strtotime($project->created_at))  }}</small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            {{-- <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png"> --}}
                            {{$project->project_framework}}
                        </li>
                    </ul>
                </td>
                <td class="project_progress">
                      {{ $project->project_description }}
                </td>
                <td class="project-state">
                  @foreach ($project_status as $ps )
                    @if ($ps->code == $project->status )
                      <span class="badge badge-{{$project->status=='PS01'?'warning':'success'}}">{{$ps->name}}</span>
                    @endif
                  @endforeach
                </td>
                <td class="project-actions text-center">

                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a onclick="view({{$project->projectID}})" class="btn btn-dark btn-sm" href="#">
                          <i class="fas fa-eye"></i>
                      </a>
                    </li>

                    
                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
                    <li class="list-inline-item">
                      <a onclick="show({{$project->projectID}})" class="btn btn-info btn-sm">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                    </li>
                    @endif
                    

                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'System Analyst')
                    <li class="list-inline-item">
                      <form action="{{ route('newproject.destroy', $project->projectID) }}" method="post">
                        @csrf
                        @method('delete')
                        <a class="btn btn-danger btn-sm buttondeleteajax" type="submit"><i class="fas fa-trash"></i> </a>
                    </form>
                    </li>
                    @endif
                  </ul>
                </td>
            </tr>
            
            @empty  
            <tr>
              <td colspan="5" align="center"><b><i>No Project Assigned</i></b></td>
            </tr>
            @endforelse
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
  
{{-- @foreach ( $model as $project )
      <div class="card" id="project">
        <a href="{{ route('modulindex', encrypt($project->projectID)) }}">
        <img class="card-img-top" src="">
          <div class="card-body">
            <h5 class="card-title">{{ $project->project_name }}</h5>
            <p class="card-text">{{ $project->project_description }}</p>
            <p class="card-text"><small class="text-muted">Created at :  {{ $project->created_at }}</small></p>
          </div>
        </a>
        <button onclick="show({{$project->projectID}})" class="btn btn-warning"><i class="fas fa-user-edit"></i>Edit</button>
        <form action="{{ route('newproject.destroy', $project->projectID) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger deleteConfirm" type="submit"><i class="fas fa-trash-alt"></i> Padam</button>
        </form>
      </div>  
    @endforeach --}}