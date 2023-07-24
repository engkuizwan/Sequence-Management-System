@extends('app.layout')

@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Function</h3>
    </div>
<div class="card-body">
    {{-- <button class="btn btn-success float-right" onclick="createfile({{$file_id}})">Add New Function</button> --}}
    <a href="{{ route("functioncreate", ['file_id' => encrypt($file_id), 'e_project_id' => $e_project_id]) }}" class="btn btn-success float-right">Add New Function</a>
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Function Name</th>
                    <th>Function Description</th>
                    <th>Creator</th>
                    <th>Created At</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($functionList as $item)
                    <tr>
                        <td>{{$item->function_name}}</td>
                        <td>{{$item->functionDesc}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{is_int($item->created_at)?  date('d-m-Y',$item->created_at) : date('d-m-Y',strtotime($item->created_at))}}</td>
                        <td align="center">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route('functionShow', ['functionId' => $item->functionID, 'e_project_id' => $e_project_id]) }}" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>
                                </li>
                  
                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
                                <li class="list-inline-item">
                                    <a href="{{ route('functionEdit', ['functionId' => $item->functionID, 'e_project_id' => $e_project_id]) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </li>
                                @endif
                  
                                
                                @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'Developer')
                                <li class="list-inline-item">
                                    <form action="{{ route('function.destroy', $item->functionID) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='file_id' value="{{$file_id}}">
                                        <input type="hidden" name='e_project_id' value="{{$e_project_id}}">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </li>
                                @endif
                  
                              </ul>
                        </td>
                    </tr>
                    @empty
                    <tr align="center">
                        <td colspan="5"> No Function Inserted </td>
                    </tr>
                    @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-2">
          {{ $functionList->links() }}
      </div>
    </div>
</div>
    
    
@endsection