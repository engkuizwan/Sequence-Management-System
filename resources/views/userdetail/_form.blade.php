
<div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-8">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{old('name')??($user_detail->name??'')}}"  {{ $disabled??'' }}>
        @error('name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="user_role" class="col-sm-2 col-form-label">Role</label>
    <div class="col-sm-8">
        <select {{$show??""==1?"disabled":""}} name="user_role" id="user_role" class="form-control @error('user_role') is-invalid @enderror" {{$disabled??''}}>
            <option selected>User Role</option>
            @foreach ($user_role as $item)
    
            <option value="{{$item->name}}"  @selected(($user_detail->user_role??'') ==  $item->name) >{{$item->name}}</option>
                
            @endforeach
        </select>
        @error('user_role')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="user_email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-8">
        <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email" name="user_email" aria-describedby="emailHelp"placeholder="www@gmail.com" value='{{old('user_email')??($user_detail->user_email??'')}}' {{ $disabled??'' }}>
        @error('user_email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="user_name" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-8">
        <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="" value='{{old('user_name')??($user_detail->user_name??'')}}' {{ $disabled??'' }}>
        @error('user_name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
{{-- <div class="row mb-3">
    <label for="user_password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-8">
        <input type="text" class="form-control @error('user_password') is-invalid @enderror" id="user_password" name="user_password" placeholder="" value='{{old('user_password')??($user_detail->user_password??'')}}' {{ $disabled }}>
        @error('user_password')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div> --}}