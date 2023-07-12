<div id="search_section" style="margin-bottom: 10px;">
  <div class="card">
      <div class="card-header" id="search_box_header" data-toggle="collapse" data-target="#search_box" aria-expanded="true" aria-controls="search_box">
          <b><i class="fas fa-search"></i> CARIAN</b>
      </div>
      <div id="search_box" class="collapse" aria-labelledby="search_box_header" data-parent="#search_section">
          <div class="card-body">
              <form id="serach_form">
                  {{-- Flow Name --}}
                  <div class="form-group row">
                      <div class="col-sm-2"></div>
                      <label class="col-sm-2 col-form-label " for=""><b>Flow Name : </b></label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="flow_name" value="">
                      </div>
                  </div>    
                  {{-- Owner --}}
                  <div class="form-group row">
                      <div class="col-sm-2"></div>
                      <label class="col-sm-2 col-form-label " for=""><b>Flow Owner : </b></label>
                      <div class="col-sm-6">
                        <select name="flow_owner" id="" class="form-control">
                          <option value="" selected>Please Choose</option>
                            @foreach ($list_member as $lm )
                            <option value="{{$lm->userID}}">{{$lm->user_name}}</option>
                            @endforeach
                        </select>
                      </div>
                  </div>    
                  <div class="form-group row">
                      <div class="col-md-12 text-center">
                          <a href="{{route('flowindex', [encrypt($modul_id), $e_project_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> Reset</a>
                          <button  class="btn btn-info btn-sm"><i class="fas fa-search"></i> Search</button>
                      </div>
                  </div>

              </form>
          </div>
      </div>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Flow</h3>
  </div>
  <div class="card-body">
    @if (auth()->user()->role == 'Admin' || auth()->user()->role->role == 'Developer')
    <button class="btn btn-info float-right" onclick="createflow({{$modul_id}})">Add New Flow</button>
    @endif
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Flow Name</th>
        <th>Flow Description</th>
        <th>Owner</th>
        <th>Created At</th>
        <th style="text-align: center;">Action</th>
      </tr>
      </thead>
      <tbody>
      @forelse ($flow as $item )
      <tr>
        {{-- <td><a href="{{route('flowindex', encrypt($item->modul_id))}}">{{$item->modul_name}}</a></td> --}}
        <td><a>{{$item->flow_name}}</a></td>
        <td>{{$item->flow_description}}</td>
        <td>{{$item->user_name}}</td>
        <td>{{is_int($item->created_at)?  date('d-m-Y',$item->created_at) : date('d-m-Y',strtotime($item->created_at))}}</td>
        
        <td align="center">
          <ul class="list-inline">
            <li class="list-inline-item">
              <button onclick="showflow({{$item->flow_id}})" class="btn btn-dark btn-sm">
                <i class="fas fa-eye"></i>
              </button>
            </li>
            
            @if (auth()->user()->role == 'Admin' || auth()->user()->role->role == 'Developer')
            <li class="list-inline-item">
              <button onclick="editflow({{$item->flow_id}})" class="btn btn-info btn-sm">
                <i class="fas fa-pencil-alt"></i>
              </button>
            </li>
            @endif

            
            @if (auth()->user()->role == 'Admin' || auth()->user()->role->role == 'Developer')
            <li class="list-inline-item">
              <form action="{{ route('flow.destroy', $item->flow_id) }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="modul_id" value="{{$modul_id}}">
                {{-- <input type="hidden" name='project_id' value="{{$item->projectID}}"> --}}
                  <button type="submit" class="btn btn-danger btn-sm buttondeleteajax" data-message2="This flow will be deleted" data-id="{{$modul_id}}" >
                    <i class="fas fa-trash"></i>
                  </button>
              </form>
            </li>
            @endif


            
          </ul>
          
          
            
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" align="center">
          <i><strong>No flow Have been store for this modul</strong></i> 
        </td>
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

</div>


{{-- Custom Js --}}
<script src="{{ asset('asset/js/custom.js') }}" type="text/javascript" charset="utf-8"></script>