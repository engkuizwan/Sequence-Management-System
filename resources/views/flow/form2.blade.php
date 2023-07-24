

    <style>

        #add_button{
            margin : 20px;
        }
        .flow_input {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 100px; /* Set the height for the container div */
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

                    <div id="list_function">
                        {{-- <div class="card">
                            <div class="card-header" id="search_box_header" data-toggle="collapse" data-target="#test1" aria-expanded="true" aria-controls="search_box">
                                <b> CARIAN</b>
                            </div>
                            <div id="test1" class="collapse" aria-labelledby="search_box_header" data-parent="">
                                <div class="card-body">
                                    <pre>
                                        public function assign_project_form($project_id)
                                        {
                                            //
                                            $data['user'] = User::all();
                                            $data['project_id']= $project_id;
                                            // dd($data);
                                            return view('project.assign_project',$data);
                                        }
                                    </pre>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    <div class="row flow_input" style="width: 100%" >

                        <div style="margin-right: 5%; text-align:center;">
                            <label for="">File</label>
                            <select name="" id="file_selected" class="form-control">
                                <option selected>Please Choose</option>
                                @forelse ($all_file as $af )
                                    @php
                                        $optionValue = json_encode([$af->file_ID, $af->file_type]);
                                    @endphp
                                    <option value="{{$optionValue}}">{{$af->file_name}}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                        
                        <div style="margin-right: 5%; text-align:center; display:none;" id="all_function">
                        </div>
                        
                        <div id="add_button" style="margin-right: 5%; display: none">
                            <a class="btn btn-primary" id="add_flow">Add</a>
                        </div>


                        
                    </div>

                </div>
                
    
            </div>
            


        </div>

            <button {{$show??""==1?"hidden":""}} type="submit" class="btn {{$edit??""==1?'btn-warning':'btn-info'}} btn-sm" style="min-width: 100%;" >{{$edit??""==1?"Edit":"Submit"}}</button>


    </form>

<script>

    
    $(document).ready(function() {
        $('#file_selected').on('change', function() {
            var file_selected_data = JSON.parse($(this).val());
            // alert(file_selected_data);
            var id = file_selected_data[0];
            var file_type = file_selected_data[1];
            if(file_type != 'View'){
                var url = '{{ route("getfunction",["file_id" => ':id']) }}';
                url = url.replace(":id",id);

                $.ajax({
                    url: url,
                    type: 'GET',

                    success: function(data) {

                        $('#add_button').css('display','block');
                        $('#all_function').css('display','block');
                        $('#all_function').empty();
                        var label = $('<label>').text('Function');
                        var select = $('<select>').attr('id','function_selected').attr('name','selected_function').attr('class','form-control');
                        
                            var option_selected = $('<option>').prop('selected', true).text('Please Choose');
                            select.append(option_selected);
                            console.log(data);
                            $.each(data.data_function, function(index, value){
                                var option = $('<option>').attr('value',value['functionID']).text(value['function_name']);
                                select.append(option);
                            });
                        

                        $('#all_function').append(label,select);

                    }
                });
            }else{
                $('#all_function').empty();
                $('#add_button').css('display','block');
            }
        });

        
        $('#add_flow').on('click', function() {
            var file_selected_data = JSON.parse($('#file_selected').val());
            var file_id = file_selected_data[0];
            var file_type = file_selected_data[1];
            var function_id = $('#function_selected').val();
            // alert(file_selected_data);
            if(file_type != 'View'){
                var url = '{{ route("getfunction_detail",["function_id" => ':id']) }}';
                url = url.replace(":id",function_id);
            }else{
                var url = '{{ route("getfunction_detail_byfile",["file_id" => ':id']) }}';
                url = url.replace(":id",file_id);
            }

                $.ajax({
                    url: url,
                    type: 'GET',

                    success: function(data) {
                        customid = data.data_function.functionID + data.data_function.file_ID;
                        var card = $('<div>').attr('class','card');
                            
                        if(file_type != 'View'){
                            var header = $('<div>').attr('class','card-header').attr('id','search_box_header').attr('data-toggle','collapse').attr('data-target','#cust-'+customid).attr('aria-expanded','true').attr('aria-controls','search_box').append($('<b>').text('File :'+data.data_function.file_name +' | Function :'+data.data_function.function_name));
                        }else{
                            var header = $('<div>').attr('class','card-header').attr('id','search_box_header').attr('data-toggle','collapse').attr('data-target','#cust-'+customid).attr('aria-expanded','true').attr('aria-controls','search_box').append($('<b>').text('File :'+data.data_function.file_name));
                        }

                        var main_body = $('<div>').attr('class','collapse').attr('id','cust-'+customid).attr('aria-labelledby','search_box_header').attr('data-parent','');
                        var body = $('<div>').attr('class','card-body').append($('<pre>').text(data.data_function.source_code));
                        main_body.append(body);
                        card.append(header, main_body);
                        $('#list_function').append(card);


                    }
                });
        });
    })

  </script>                                                                             
  
