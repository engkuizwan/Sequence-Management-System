@extends('app.layout')

@section('content')

<form action="{{route('function.store')}}" method="post">
    @csrf
    <input type="hidden" name="e_project_id" value="{{$e_project_id}}">
    <div class="text-center" style="margin-left:45%; margin-bottom:10px;">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    @include('function._form')

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
@endsection