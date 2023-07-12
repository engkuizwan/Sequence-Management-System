    <form action="{{route('assign_member_action')}}" id="modul_add" method="post">
        {{-- <form> --}}
            <input type="hidden" name='project_id' id="project_id" value="{{$project_id}}">
        @csrf
        {{-- @if ($edit??""==1)
            @method('put')
        @endif --}}
        


            <div class="form-group">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <select name="user_id" id="user" class="form-control @error('user_id') is-invalid @enderror" {{ $disabled??'' }}>
                        <option value="">- Please Choose - </option>
                        @foreach ($user as $u)
                            <option  value="{{$u->userID}}" >{{$u->name}}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
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

            <button type="submit" class="btn btn-success">{{"Submit"}}</button>


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
  
