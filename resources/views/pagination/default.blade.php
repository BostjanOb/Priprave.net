<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
</div>
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex gap-3 md:hidden">
            @if ($paginator->onFirstPage())
                <span class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground opacity-40">
                    <x-icon-regular.angle-left class="size-4" />
                    Nazaj
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                >
                    <x-icon-regular.angle-left class="size-4" />
                    Nazaj
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                >
                    Naprej
                    <x-icon-regular.angle-right class="size-4" />
                </a>
            @else
                <span class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground opacity-40">
                    Naprej
                    <x-icon-regular.angle-right class="size-4" />
                </span>
            @endif
        </div>

        <div class="hidden items-center justify-center gap-2 md:flex">
            @if ($paginator->onFirstPage())
                <span class="flex size-10 items-center justify-center rounded-xl border border-border bg-card text-muted-foreground opacity-40">
                    <x-icon-regular.angle-left class="size-4" />
                </span>
            @else
                <a
                    href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    class="flex size-10 items-center justify-center rounded-xl border border-border bg-card text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                    aria-label="@lang('pagination.previous')"
                >
                    <x-icon-regular.angle-left class="size-4" />
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-1 text-muted-foreground">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="flex size-10 items-center justify-center rounded-xl border border-teal-400 bg-teal-500 text-sm font-semibold text-white shadow-md shadow-teal-200/50 dark:shadow-teal-900/30">
                                {{ $page }}
                            </span>
                        @else
                            <a
                                href="{{ $url }}"
                                class="flex size-10 items-center justify-center rounded-xl border border-border bg-card text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                            >
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    class="flex size-10 items-center justify-center rounded-xl border border-border bg-card text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                    aria-label="@lang('pagination.next')"
                >
                    <x-icon-regular.angle-right class="size-4" />
                </a>
            @else
                <span class="flex size-10 items-center justify-center rounded-xl border border-border bg-card text-muted-foreground opacity-40">
                    <x-icon-regular.angle-right class="size-4" />
                </span>
            @endif
        </div>
    </nav>
@endif
