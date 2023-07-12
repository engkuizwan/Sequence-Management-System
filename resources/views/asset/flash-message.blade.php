<script>
    $(function() { 
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}');
        @elseif ($message = Session::get('error'))
            toastr.error('{{ $message }}');
        @elseif ($message = Session::get('warning'))
            toastr.warning('{{ $message }}');
        @elseif ($message = Session::get('info'))
            toastr.info('{{ $message }}');
        @endif
    });
    function success(msg) {
        toastr.success(msg);
    }
    function error(msg) {
        toastr.error(msg);
    }

    window.addEventListener('alert',({detail:{type,message}})=>{
        toastr[type](message)
    })
</script>