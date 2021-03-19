@if ($paginator->hasPages())
    <div class="col-12 text-center pb-4 pt-4">
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between text-center">

            <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('main.showingTo') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('main.to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('main.of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('main.results') !!}
                </p>
            </div>
                @if ($paginator->onFirstPage())
                <a href="#" class="btn_mange_pagging">&nbsp;&nbsp; {!! __('pagination.previous') !!}</a>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn_mange_pagging"> &nbsp;&nbsp; {!! __('pagination.previous') !!}</a>
                @endif
                @foreach ($elements as $element)
                        @if (is_string($element))
                            <a href="#" class="btn_pagging">{{ $element }}</a>
                        @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <a href="#" class="btn_pagging">{{ $page }}</a>
                                    @else
                                        <a href="{{ $url }}" class="btn_pagging">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif
                    @endforeach
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn_mange_pagging">{!! __('pagination.next') !!} &nbsp;&nbsp; </a>
                    @else
                        <a href="#" class="btn_mange_pagging">{!! __('pagination.next') !!} &nbsp;&nbsp; </a>
                    @endif
            </div>
    </nav>
    </div>
@endif
