<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
</div>
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex gap-3">
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
    </nav>
@endif
