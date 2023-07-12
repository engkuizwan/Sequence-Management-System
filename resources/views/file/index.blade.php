@extends('app.layout')

@section('content')

{{-- <div> --}}
    {{-- <a href="{{ route('projectadd') }}" class="btn btn-success float-right upModalCustom"><i class="fas fa-user-plus"></i> Tambah </a> --}}
    {{-- <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal">Tambah</button> --}}
{{-- </div> --}}

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
    Open Modal
  </button> --}}
  




  <div class="card-deck" id="listproject">

    @foreach ( $model as $project )
    <a href="{{ route('modulindex',$project->projectID) }}">
      <div class="card" id="project">
        <img class="card-img-top" src="" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{ $project->project_name }}</h5>
          <p class="card-text">{{ $project->project_description }}</p>
          <p class="card-text"><small class="text-muted">Created at :  {{ $project->created_at }}</small></p>
        </div>
      </div>  
    </a>
    @endforeach

    {{-- <a href="{{ route('projectview', 'form') }}" data-toggle="modal" data-target="#modal">Open Modal with Your View</a> --}}

    

    {{-- <div> --}}
        {{-- <a href="{{ route('projectadd') }}" class="btn btn-success float-right upModalCustom"><i class="fas fa-user-plus"></i> Tambah </a> --}}
        <a id="buttonaddproject" data-toggle="modal" data-target="#modal" >
            <img id="addproject"  src="{{ asset('asset/icon/plus-square.svg') }}" alt="Example">
        </a>
        <x-modal>
          @include('file.form')
        </x-modal>
    {{-- </div> --}}

  </div>



@endsection