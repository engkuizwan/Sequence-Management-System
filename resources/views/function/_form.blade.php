<div class="container">
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Function Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control @error('func_name') is-invalid @enderror" id="func_name" name="func_name" placeholder="index" value="{{old('func_name')??($funcDetail->function_name??'')}}"  {{ $disabled??'' }}>
            @error('func_name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Function Description</label>
        <div class="col-sm-8">
            <textarea type="text" class="form-control @error('func_desc') is-invalid @enderror" id="func_desc" name="func_desc" placeholder="The Description of your Function is here" {{ $disabled??'' }}>{{old('func_desc')??($funcDetail->functionDesc??'')}} </textarea>
            @error('func_desc')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">User Name</label>
        <div class="col-sm-4">
            <select name="user" id="user" class="form-control @error('user') is-invalid @enderror" {{ $disabled??'' }}>
                    <option value="">- Please Choose - </option>
                @foreach ($user as $key=>$val)
                    <option {{(($funcDetail->name??'')==$val?'selected':'')}} value="{{$key}}" >{{$val}}</option>
                @endforeach
            </select>
            @error('user')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    {{-- <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Role Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" placeholder="Admin IT" value="{{old('role')??($funcDetail->roleID??'')}}"  {{ $disabled??'' }}>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div> --}}
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">File Name</label>
        <div class="col-sm-4">
            <select name="file" id="file" class="form-control" @readonly(true) {{ $disabled??'' }}>
                <option value="{{old('file')??($funcDetail->file_ID??($file->file_ID??''))}}">{{old('file')??($funcDetail->file_name??($file->file_name??''))}}</option>
            </select>
        </div>
    </div>
</div>