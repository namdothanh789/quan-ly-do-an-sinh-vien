@if ($paginator->hasPages())
<nav aria-label="...">
    <ul class="pagination justify-content-end mb-0">
        <li class="page-item disabled">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item @if ($page == $paginator->currentPage()) active  @endif">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                <i class="fas fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
@endif