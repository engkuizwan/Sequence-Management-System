@extends('app.layout')

@section('content')


    {{-- list --}}
    <div id="list">
      
    </div>
    
    <input type="hidden" name="user_role" value="{{$user[0]->role??""}}" id="user_role">
    <input type="hidden" name="user_id" value="{{$user[0]->id??""}}" id="user_id">

    <script>

      $(document).ready(function(){
        if($('#user_role').val() == 1){
          readuser($('#user_id').val());
        }else if($('#user_role').val() == 0){
          read();
        }
        // read();
      })

      function read(){
        $.get("{{ url('project_list') }}", {}, function(data,status){
          $('#list').html(data);
        });
      }

      function create(){
        $.get("{{ route('newproject.create') }}", {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Create Project');
        });
      }

      function show(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('project_show') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('Update Project');
        });
      }


      function view(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('project_view') }}/"+id, {}, function(data,status){
          $('#page').html(data);
          $('#modal').modal('show');
          $('#modallable').html('View Project');
        });
      }

      


      function store(){
            var name = $("#name").val();
            $.ajax({
                type: "post",
                url: "{{route('newproject.store')}}",
                data: {
                "_token": "{{ csrf_token() }}",
                "name" : name
                },
                success: function(data) {
                $(".btn-close").click();
                read();
                }
            });
        }

        function readuser(project_id){
        $.get("{{ url('project_list') }}/"+project_id, {}, function(data,status){
          $('#list').html(data);
        });
      }

      // const form = document.getElementById('project_add');

      // form.addEventListener('submit', function(event) {
      //   event.preventDefault(); // prevent the form from submitting normally

      //   const formData = new FormData(form); // get the form data

      //   fetch('{{ route('projectstore') }}', {
      //     method: 'POST',
      //     body: formData
      //   })
      //   .then(response => {
      //     if (response.ok) {
      //       $(".btn-close").click();
      //       console.log('Form submitted successfully!');
      //     } else {
      //       // handle error response
      //       console.error('Error submitting form');
      //     }
      //   })
      //   .catch(error => {
      //     console.error('Error submitting form:', error);
      //   });
      // });






    </script>

@endsection
