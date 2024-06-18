{{$msg = $typeNoti."!"}}

@if ($active)
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.{{$typeNoti}}("{{ $message }}", "{{ $title }}", {timeOut: {{ $timeOut }} });
    </script>
@endif