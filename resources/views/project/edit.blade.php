<script src="{{ asset('asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
  $('.editConfirm').click(function(event) {
      // alert('test');
      var form = $(this).parents('form');
      event.preventDefault();
      Swal.fire({
          title: 'Are you sure?',
          text: 'This project will be move to archive',
          icon: 'warning',
          showDenyButton: true,
          confirmButtonColor: '#3085d6',
          denyButtonColor: '#d33',
          denyButtonText: 'No',
          confirmButtonText: 'Yes',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
          // disable the button to prevent multiple clicks
          $(this).attr('disabled', true);
          
          // submit the form using AJAX
          $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
              // show the success message
              Swal.fire(
                'Successfull',
                'Project have been moved to archive',
                'success'
              );
              
              // reload the page after a short delay
              setTimeout(function() {
                // location.reload();
                read();
              }, 2000);
            },
            error: function(xhr) {
              // show an error message
              Swal.fire(
                'Error',
                'The form could not be submitted',
                'error'
              );
              
              // re-enable the button
              $(this).attr('disabled', false);
            }
          });
          } else if (result.isDenied) {
              Swal.fire(
              'Tindakan Dibatalkan',
              'Tiada tindakan dilakukan',
              'error'
              )
          }
      })
  });    
</script>
    {{-- <form action="{{route('newproject.store')}}" id="project_add" method="post"> --}}
        <form>
        {{-- @csrf
        @method('put') --}}


            <div class="form-group">
                <label for="">Name</label>
                <input {{$show??"" == 1? 'readonly':''}} type="text" name="project_name" value="{{ $project->project_name??""?$project->project_name:old('project_name'??'') }}" 
                class="form-control @error('project_name') is-invalid @enderror" placeholder="Project Name" id='project_name'>
                @error('project_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input {{$show??"" == 1? 'readonly':''}} type="text" name="project_description" value="{{ $project->project_description??""?$project->project_description:old('project_description' ?? '') }}"  
                class="form-control @error('project_description') is-invalid @enderror" placeholder="Description" id='project_description'>
                @error('project_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="">Framework</label>
                <input {{$show??"" == 1? 'readonly':''}} type="text" name="project_framework" value="{{  $project->project_framework??""?$project->project_framework:old('project_framework' ?? '') }}" 
                class="form-control @error('project_framework') is-invalid @enderror" placeholder="Project Framework" id='project_framework'>
                @error('project_framework')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if ($show != 1)
            <a type="button" class="btn btn-warning " onclick="update({{$project->projectID}})">Edit</a>
            @endif


    </form>

<script>
    function update(id){
        event.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: 'This project will be updated',
          icon: 'warning',
          showDenyButton: true,
          confirmButtonColor: '#3085d6',
          denyButtonColor: '#d33',
          denyButtonText: 'No',
          confirmButtonText: 'Yes',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
          // disable the button to prevent multiple clicks
          $(this).attr('disabled', true);
          
          var project_name = $("#project_name").val();
          var project_description = $("#project_description").val();
          var project_framework = $("#project_framework").val(); 
          // submit the form using AJAX
          $.ajax({
            type: "post",
            url: "{{ url('project_update') }}/" + id,
            data: {
                "_token": "{{ csrf_token() }}",
                "project_name" : project_name,
                "project_framework" : project_framework,
                "project_description" : project_description
            },
            success: function(response) {
              // show the success message
              Swal.fire(
                'Successfull',
                'Project have been update',
                'success'
              );
              
              // reload the page after a short delay
              setTimeout(function() {
                // location.reload();
                $(".btn-close").click();
                read();
                read();
              }, 2000);
            },
            error: function(xhr) {
              // show an error message
              Swal.fire(
                'Error',
                'The form could not be submitted',
                'error'
              );
              
              // re-enable the button
              $(this).attr('disabled', false);
            }
          });
          } else if (result.isDenied) {
              Swal.fire(
              'Tindakan Dibatalkan',
              'Tiada tindakan dilakukan',
              'error'
              )
          }
      })
        //     var project_name = $("#project_name").val();
        //     var project_description = $("#project_description").val();
        //     var project_framework = $("#project_framework").val(); 
        //     // alert(project_framework);
        // $.ajax({
        //     type: "post",
        //     url: "{{ url('project_update') }}/" + id,
        //     data: {
        //         "_token": "{{ csrf_token() }}",
        //         "project_name" : project_name,
        //         "project_framework" : project_framework,
        //         "project_description" : project_description
        //     },
        //     success: function(data){ 
        //         $(".btn-close").click();
        //         read();
        //     }
        // });
    }
  </script>
  
