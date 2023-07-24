@extends('app.layout')

@section('content')
@if ($funcDetail == null)
        <form action="{{route('store_view')}}" method="post">
            @csrf
            @include('function._form_view')

            <input type="hidden" name="e_project_id" value="{{$e_project_id}}">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
@else
        <form action="{{route('update_view')}}" method="post">
            @csrf
            @include('function._form_view')
            <input type="hidden" name="function_id" value="{{$funcDetail->functionID}}">
            <input type="hidden" name="e_project_id" value="{{$e_project_id}}">
            <div class="text-center">
                <button type="submit" class="btn btn-info">Update</button>
            </div>

        </form>
@endif
@endsection