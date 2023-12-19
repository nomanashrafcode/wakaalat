<div class="row">
    <div class="col-12">
        <div class="pagination">
            <ul class="page-numbers">
                @if ($paginator->onFirstPage())

                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-long-arrow-alt-left"></i></a>
                    </li>
                @endif

                @foreach ($elements as $element)

                    @if (count($element) < 2)


                    @else

                        @foreach ($element as $key => $el) <li>
                        @if ($key == $paginator->currentPage())
                            <span>{{ $key }}</span></li>
                        @else
                            <li>
                            <a href="{{ $el }}">{{ $key }}</a>
                            </li> @endif
                        @endforeach
                    @endif
                @endforeach


                @if ($paginator->hasMorePages())
                 <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-long-arrow-alt-right"></i></a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>
