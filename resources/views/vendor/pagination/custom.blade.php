@if ($paginator->hasPages())
    <nav class="datatable-pagination">
        <ul class="datatable-pagination-list">
            {{-- Previous Page Link --}} @if ($paginator->onFirstPage())
                <li class="datatable-pagination-list-item datatable-hidden datatable-disabled" aria-disabled="true"
                    aria-label="@lang('pagination.previous')">
                    <a aria-hidden="true" class="datatable-pagination-list-item-link">&lsaquo;</a>
                </li>
            @else
                <li class="datatable-pagination-list-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                        class="datatable-pagination-list-item-link">&lsaquo;</a>
                </li>
                @endif {{-- Pagination Elements --}} @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}} @if (is_string($element))
                        <li class="datatable-pagination-list-item datatable-hidden datatable-disabled"
                            aria-disabled="true">
                            <a data-page="1" class="datatable-pagination-list-item-link">{{ $element }}</a>
                        </li>
                        @endif {{-- Array Of Links --}} @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="datatable-pagination-list-item datatable-active" aria-current="page">
                                        <a data-page="1"
                                            class="datatable-pagination-list-item-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="datatable-pagination-list-item">
                                        <a data-page="{{ $page }}" href="{{ $url }}"
                                            class="datatable-pagination-list-item-link">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        @endforeach {{-- Next Page Link --}} @if ($paginator->hasMorePages())
                            <li class="datatable-pagination-list-item">
                                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"
                                    class="datatable-pagination-list-item-link">&rsaquo;</a>
                            </li>
                        @else
                            <li class="datatable-pagination-list-item datatable-hidden datatable-disabled"
                                aria-disabled="true" aria-label="@lang('pagination.next')">
                                <a aria-hidden="true" class="datatable-pagination-list-item-link">&rsaquo;</a>
                            </li>
                        @endif
        </ul>
    </nav>
@endif
