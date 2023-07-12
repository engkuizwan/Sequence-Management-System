@extends('app.layout')

@section('content')

<form action="{{route('function.store')}}" method="post">
    @csrf
    @include('function._form')

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
@endsection