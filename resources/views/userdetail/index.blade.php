@extends('app.layout')

@section ('content')
<div class="breadcrumb" style="width: 60%; margin:20px auto;">
    <div class="container">
        <h4  align="center" style="font-weight:bold;"><?='Tajuk Besar'?></h4>
        <form>
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{request('name')}}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-8">
                    <select {{$show??""==1?"disabled":""}} name="user_role" id="user_role" class="form-control @error('user_role') is-invalid @enderror" {{$disabled??''}}>
                        <option selected>User Role</option>
                        @foreach ($user_role as $item )
                
                        <option value="{{$item->name}}"  @selected(($user_detail->user_role??'') ==  $item->name) >{{$item->name}}</option>
                            
                        @endforeach
                    </select>
                    @error('user_role')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp"placeholder="www@gmail.com" value="{{request('user_email')}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div style="align:right;">
    <a class="btn btn-info" href="{{route('userdetail.create')}}">CREATE</a>
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Role</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
<?php
$n=1;
foreach ($user_detail as $val) {
?>
    <tr>
        <th scope="row"><?=$n++;?></th>
        <td><a href="{{ route('userdetail.show', $val) }}"><?=$val->name?></a></td>
        <td><?=$val->user_role?></td>
        <td><?=$val->user_email?></td>
        <td>
            <a class="btn btn-info" href="{{route('userdetail.edit',$val)}}">Edit</a>
            <form action="{{route('userdetail.destroy',$val)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">DELETE</button>
            </form>
            {{-- <a class="btn btn-danger" href="{{route('userdetail.destroy',$val)}}">Delete</a> --}}
        </td>
      </tr>
<?php }
?>
    </tbody>
  </table>
@endsection