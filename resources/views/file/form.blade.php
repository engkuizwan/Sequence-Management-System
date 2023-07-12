    <form action="{{ $edit??''==1?route('update_file', $file->file_ID):route('file.store')}}" id="file_add" method="post">
        {{-- <form> --}}
        <input type="hidden" name='project_id' id="project_id">
        @csrf
        @if ($edit??""==1)
            @method('put')
        @endif


            <div class="form-group">
                <label for="">File Name</label>
                <input {{$show??""==1?"readonly":""}} type="text" name="file_name" value="{{ $file->file_name??""?$file->file_name:old('file_name'??'') }}" 
                class="form-control @error('file_name') is-invalid @enderror" placeholder="File name">
                @error('file_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">File Type</label>
                <select {{$show??""==1?"disabled":""}} name="file_type" id="file_type" class="form-control" {{$disabled??''}}>
                    <option selected>Select Type Of File</option>
                    @foreach ($type_file as $item )

                    <option value="{{$item->name}}"  @selected(($file->file_type??'') ==  $item->name) >{{$item->name}}</option>
                        
                    @endforeach
                </select>
                @error('file_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
           

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
  
