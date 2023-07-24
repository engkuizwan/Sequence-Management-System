<div class="container">
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">View Description</label>
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
                <option value="{{old('file')??($funcDetail->file_ID??$file_id??'')}}">{{$file->file_name??''}}</option>
            </select>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Source Code</label>
        <div class="col-sm-8">
            {{-- <input type="text" class="form-control @error('source_code') is-invalid @enderror" id="source_code" name="source_code" placeholder="Paste your source code here" value="{{old('source_code')??($funcDetail->function_name??'')}}"  {{ $disabled??'' }}> --}}
            <textarea class="form-control @error('source_code') is-invalid @enderror" id="source_code" name="source_code" placeholder="Paste your source code here" {{ $disabled??'' }} cols="100" rows="100">{{old('source_code')??($funcDetail->source_code??'')}}</textarea>
            @error('source_code')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>