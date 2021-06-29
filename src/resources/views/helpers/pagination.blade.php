@if ($paginator->hasPages())
    <ul class="pager">

        @if ($paginator->onFirstPage())
            <li class="disabled prev"><span><i class="fas fa-arrow-alt-circle-left"></i></span></li>
        @else
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-arrow-alt-circle-left"></i></a></li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}"  rel="next"><i class="fas fa-arrow-alt-circle-right"></i></a></li>
        @else
            <li class="disabled next"><span><i class="fas fa-arrow-alt-circle-right"></i></span></li>
        @endif
    </ul>
@endif
