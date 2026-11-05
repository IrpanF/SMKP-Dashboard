@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
        class="flex items-center gap-1">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-300">
                &lsaquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-emerald-50 hover:text-emerald-700">
                &lsaquo;
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)

            @if (is_string($element))
                <span class="inline-flex h-9 items-center px-2 text-sm text-slate-400">
                    {{ $element }}
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                            class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-emerald-600 bg-emerald-600 px-3 text-sm font-semibold text-white shadow-sm">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-slate-200 bg-white px-3 text-sm font-medium text-slate-600 transition hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-emerald-50 hover:text-emerald-700">
                &rsaquo;
            </a>
        @else
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-300">
                &rsaquo;
            </span>
        @endif

    </nav>
@endif
