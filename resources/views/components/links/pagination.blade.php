@props(['data'])

<div class="pagination">
    @if ($data->onFirstPage())
        {{-- <a href="{{ $data->previousPageUrl() }}" class="disabled">&laquo;</a> --}}
    @else
        <a href="{{ $data->previousPageUrl() }}">&laquo;</a>
    @endif

    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
        @if ($page == $data->currentPage())
            <a href="{{ $url }}" class="active">{{ $page }}</a>
        @else
            <a href="{{ $url }}">{{ $page }}</a>
        @endif
    @endforeach

    @if ($data->hasMorePages())
        <a href="{{ $data->nextPageUrl() }}">&raquo;</a>
    @else
        {{-- <span>&raquo;</span> --}}
    @endif
</div>
