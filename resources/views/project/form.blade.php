    <form action="{{route('newproject.store')}}" id="project_add" method="post">
        {{-- <form> --}}
        @csrf


            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="project_name" value="{{ old('project_name'??'') }}" 
                class="form-control @error('project_name') is-invalid @enderror" placeholder="Project Name">
                @error('project_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
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
            </div>

            <button type="submit" class="btn btn-success buttonsaveajax">Submit</button>


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
  
