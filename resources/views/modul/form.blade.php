    <form action="{{ $edit??""==1?route('modul.update', $modul->modul_id):route('modul.store')}}" id="modul_add" method="post">
        {{-- <form> --}}
            <input type="hidden" name='project_id' id="project_id">
        @csrf
        @if ($edit??""==1)
            @method('put')
        @endif
        


            <div class="form-group">
                <label for="">Module Name</label>
                <input {{$show??""==1?"readonly":""}} type="text" name="modul_name" value="{{ $modul->modul_name??""?$modul->modul_name:old('modul_name'??'') }}" 
                class="form-control @error('modul_name') is-invalid @enderror" placeholder="Module Name">
                @error('modul_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="project_description" value="{{ old('project_description' ?? '') }}"  
                class="form-control @error('project_description') is-invalid @enderror" id="exampleInputPassword1" 
                placeholder="Description">
                @error('project_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="">Framework</label>
                <input type="text" name="project_framework" value="{{ old('project_framework' ?? '') }}" 
                class="form-control @error('project_framework') is-invalid @enderror" id="exampleInputPassword1" 
                placeholder="Project Framework">
                @error('project_framework')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            <button type="submit" class="btn {{$edit??""==1?'btn-warning':'btn-success'}}">{{$edit??""==1?"Edit":"Submit"}}</button>


    </form>

<script>
    // function store(){
    //     alert();
    //         var name = $("#name").val();
    //         $.ajax({
    //             type: "post",
    //             url: "{{route('newproject.store')}}",
    //             data: {
    //             "_token": "{{ csrf_token() }}",
    //             "name" : name
    //             },
    //             success: function(data) {
    //             $(".btn-close").click();
    //             read();
    //             }
    //         });
    //     }
  </script>
  
