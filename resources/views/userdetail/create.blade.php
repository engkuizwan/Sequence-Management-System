@extends('app.layout')

@section ('content')
<div class="breadcrumb" style="width: 60%; margin:20px auto;">
    <div class="container">
        <h4  align="center" style="font-weight:bold;"> User Information</h4>
        <form action="{{route('userdetail.store')}}" method="POST">
            @csrf
            @include('userdetail._form')
           
            <button type="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-primary" href="javascript:history.go(-1)">Back</a>
        </form>
    </div>
</div>
@endsection