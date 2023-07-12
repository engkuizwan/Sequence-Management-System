@extends('app.layout')

@section('content')

    <style>
      .box-list{
        overflow-y:auto;
        min-height: 70%;
        /* max-width: 20%; */
      }
    </style>
    {{-- list --}}
    <div class="flow-list" id="flow-list"></div>
    <input type="hidden" id="modul_id" value="{{$modul_id}}">
    <input type="hidden" id="flow_name" value="{{$flow_name??0}}">
    <input type="hidden" id="flow_owner" value="{{$flow_owner??0}}">
    <script>

      $(document).ready(function(){
        var modul_id = $('#modul_id').val();
        var flow_name = $('#flow_name').val();
        var flow_owner = $('#flow_owner').val();
        read(modul_id,flow_name,flow_owner);

      })

      function read(modul_id, flow_name, flow_owner){
        // alert(modul_id)
        $.get("{{ url('flow_senarai') }}/"+modul_id+"/"+flow_name+"/"+flow_owner, {}, function(data,status){
          $('#flow-list').html(data);
        });
      }

      function createflow(modul_id){
        // alert(modul_id);
        $.get("{{ url('flow_create')}}/"+modul_id, {}, function(data,status){
          $('#page-flow').html(data);
          $('#modal-flow').modal('show');
          $('#modallable-flow').html('Create Flow');
          $('#modul_id').val(modul_id); //to set value
        });
      }

      function showflow(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('flow_show') }}/"+id, {}, function(data,status){
          $('#page-flow').html(data);
          $('#modal-flow').modal('show');
          $('#modallable-flow').html('Show Flow');
        });
      }

      function editflow(id){
        // alert(id);
        // var id1 = id;
        $.get("{{ url('flow_edit') }}/"+id, {}, function(data,status){
          $('#page-flow').html(data);
          $('#modal-flow').modal('show');
          $('#modallable-flow').html('Update Flow');
        });
      }
      


    //   function store(){
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
