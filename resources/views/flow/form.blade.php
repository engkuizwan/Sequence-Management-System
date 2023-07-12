

    <style>

        #add_button{
            margin : 20px;
        }

    </style>



    <form action="{{ $edit??""==1?route('flow.update', $modul->modul_id??""):route('flow.store')}}" id="flow_add" method="post">
        {{-- <form> --}}
            <input type="hidden" name='modul_id' id="modul_id" value="{{$modul_id??''}}">
            <input type="hidden" name='e_project_id' id="e_project_id" value="{{$e_project_id??''}}">
        @csrf
        @if ($edit??""==1)
            @method('put')
        @endif
        <div style="margin : 10px;">
            <div id=list-flow>

                <div style="float: top;">

                    <div class="form-group" style="float: top;">
                        <label for="">Flow Name</label>
                        <input {{$show??""==1?"readonly":""}} type="text" name="flow_name" value="{{ $flow->flow_name??""?$flow->flow_name:old('flow_name'??'') }}" 
                        class="form-control @error('flow_name') is-invalid @enderror" placeholder="Flow Name">
                        @error('flow_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Flow Description</label>
                        {{-- <input {{$show??""==1?"readonly":""}} type="textarea" name="flow_description" value="{{ $flow->flow_description??""?$flow->flow_description:old('flow_description'??'') }}" 
                        class="form-control @error('flow_description') is-invalid @enderror" placeholder="Flow Description"> --}}
                        <textarea {{$show??""==1?"readonly":""}} name="flow_description"  
                            class="form-control @error('flow_description') is-invalid @enderror" placeholder="Flow Description">
                            {{ $flow->flow_description??""?$flow->flow_description:old('flow_description'??'') }}
                        </textarea>
                        @error('flow_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                @if ($flow != null)
                
                @foreach (json_decode($flow->all_id, true) as $item )

                    @if ($item['type']=='file')

                        @foreach ($all_file as $item2 )
                            
                            @if ($item2->file_ID == $item['id'] && $item2->file_type == 'Controller' )

                                <div class="card" style="padding: 20px; background-color: #17A2B8;">
                                    <div class="form-group">
                                        <label for="">Controller Name</label>
                                        <select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2">
                                            <option selected>Please Select</option>
                                            @foreach ($controller as $item3 )
                                            <option {{$item3->file_ID == $item['id']? "selected":""}} value="{{'file:'.$item3->file_ID}}">{{$item3->file_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('file_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="float: right;">
                                        <a class="btn btn-danger btn-circle btn-sm delete-row">Remove</a>
                                    </div>
                                </div>
                            @endif

                            @if ($item2->file_ID == $item['id'] && $item2->file_type == 'View')
                                <div class="card" style="padding: 20px; background-color: #FFC107;">
                                    <div class="form-group">
                                        <label for="">View Name</label>
                                        <select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2">
                                            <option selected>Please Select</option>
                                            @foreach ($view as $item3 )
                                            <option {{$item3->file_ID == $item['id']? "selected":""}} value="{{'file:'.$item3->file_ID}}">{{$item3->file_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('file_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="float: right;">
                                        <a class="btn btn-danger btn-circle btn-sm delete-row">Remove</a>
                                    </div>
                                </div>
                            @endif

                            @if ($item2->file_ID == $item['id'] && $item2->file_type == 'Model')
                                <div class="card" style="padding: 20px; background-color: #DC3545;">
                                    <div class="form-group">
                                        <label for="">Model Name</label>
                                        <select name="file_name[]" id="file_name" class="form-control select2" {{$show??""==1?"disabled":""}}>
                                            <option {{$show??""==1?"disabled":""}} selected>Please Select</option>
                                            @foreach ($model as $item3 )
                                            <option {{$item3->file_ID == $item['id']? "selected":""}} value="{{"file:".$item3->file_ID}}">{{$item3->file_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('file_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="float: right;">
                                        <a class="btn btn-danger btn-circle btn-sm delete-row">Remove</a>
                                    </div>
                                </div>
                            @endif

                            @if ($item2->file_ID == $item['id'] && $item2->file_type == 'Helper')
                                <div class="card" style="padding: 20px; background-color: #28A745;">
                                    <div class="form-group">
                                        <label for="">Helper Name</label>
                                        <select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2" {{$show??""==1?"disabled":""}}>
                                            <option selected>Please Select</option>
                                            @foreach ($helper as $item3 )
                                            <option {{$item3->file_ID == $item['id']? "selected":""}} value="{{"file:".$item3->file_ID}}">{{$item3->file_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('file_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div style="float:right;">
                                        <a class="btn btn-danger btn-circle btn-sm delete-row">Remove</a>
                                    </div>
                                </div>   
                            @endif

                        @endforeach
                        
                    @endif
                    
                @endforeach

                @endif

                
                
                {{-- <div class="card" style="padding: 20px;background-color: hsl(197, 92%, 90%);  ">
                    <div class="form-group">
                        <label for="">Controller Name</label>
                        <select {{$show??""==1?"disabled":""}} name="file_name" id="file_name" class="form-control select2">
                            <option selected>Please Select</option>
                            @foreach ($controller as $item )
                            <option value="{{$item->file_id}}">{{$item->file_name}}</option>
                            
                            @endforeach
                        </select>
                        @error('file_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    
                    <div style="float:right;">
                        <a class="btn btn-danger btn-circle btn-sm  delete-row" >
                            <i class="fa fa-minus" aria-hidden="true"></i>
                            Remove
                        </a>
                    </div>

                </div> --}}
                
    
            </div>
            

            <div  id='list-addbuton' style="display: flex" {{$show??""==1?"hidden":""}}>
                <button type="button" id="add_button" class="btn btn-block btn-outline-info btn-sm add_controller" >+Controller</button>
                <button type="button" id="add_button" class="btn btn-block btn-outline-warning btn-sm add_view" >+View</button>
                <button type="button" id="add_button" class="btn btn-block btn-outline-danger btn-sm add_model" >+Model</button>
                <button type="button" id="add_button" class="btn btn-block btn-outline-success btn-sm add_helper" >+Helper</button>
            </div>

        </div>

            <button {{$show??""==1?"hidden":""}} type="submit" class="btn {{$edit??""==1?'btn-warning':'btn-info'}} btn-sm" style="min-width: 100%;" >{{$edit??""==1?"Edit":"Submit"}}</button>


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
        $('.add_controller').click(function(){
                var numCards = $("div.card").length;

                // Create a new card element with required HTML code
                var newCard = $("<div>").addClass("card").css({"padding": "20px", "background-color": "#17A2B8"});
                newCard.html('<div class="form-group"><label for="">Controller Name</label><select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2"><option selected>Please Select</option>@foreach ($controller as $item )<option value="{{"file:".$item->file_ID}}">{{$item->file_name}}</option>@endforeach</select>@error('file_type')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div style="float:right;"><a class="btn btn-danger btn-circle btn-sm  delete-row" >Remove</a></div>');
                newCard.appendTo('#list-flow');
        });
        // 
        $('.add_view').click(function(){
                var numCards = $("div.card").length;

                // Create a new card element with required HTML code
                var newCard = $("<div>").addClass("card").css({"padding": "20px", "background-color": "#FFC107"});
                newCard.html('<div class="form-group"><label for="">View Name</label><select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2"><option selected>Please Select</option>@foreach ($view as $item )<option value="{{"file:".$item->file_ID}}">{{$item->file_name}}</option>@endforeach</select>@error('file_type')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div style="float:right;"><a class="btn btn-danger btn-circle btn-sm  delete-row" >Remove</a></div>');
                newCard.appendTo('#list-flow');
        });

        $('.add_model').click(function(){
                var numCards = $("div.card").length;

                // Create a new card element with required HTML code
                var newCard = $("<div>").addClass("card").css({"padding": "20px", "background-color": "#DC3545"});
                newCard.html('<div class="form-group"><label for="">Model Name</label><select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2"><option selected>Please Select</option>@foreach ($model as $item )<option value="{{"file:".$item->file_ID}}">{{$item->file_name}}</option>@endforeach</select>@error('file_type')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div style="float:right;"><a class="btn btn-danger btn-circle btn-sm  delete-row" >Remove</a></div>');
                newCard.appendTo('#list-flow');
        });

        $('.add_helper').click(function(){
                var numCards = $("div.card").length;

                // Create a new card element with required HTML code
                var newCard = $("<div>").addClass("card").css({"padding": "20px", "background-color": "#28A745"});
                newCard.html('<div class="form-group"><label for="">Helper Name</label><select {{$show??""==1?"disabled":""}} name="file_name[]" id="file_name" class="form-control select2"><option selected>Please Select</option>@foreach ($helper as $item )<option value="{{"file:".$item->file_ID}}">{{$item->file_name}}</option>@endforeach</select>@error('file_type')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div style="float:right;"><a class="btn btn-danger btn-circle btn-sm  delete-row" >Remove</a></div>');
                newCard.appendTo('#list-flow');
        });

         // Find and remove selected table rows
            $('#delete-file').click(function()
            {
                // i--;
                // o--;
                $(this).closest("div").remove();
            }); 
  </script>                                                                             
  
