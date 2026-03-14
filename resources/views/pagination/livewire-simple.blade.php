<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>
@php
    $isCursorPaginator = $paginator instanceof \Illuminate\Pagination\CursorPaginator;
@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex gap-3">
            @if (($isCursorPaginator && $paginator->previousCursor() === null) || (! $isCursorPaginator && $paginator->onFirstPage()))
                <span class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground opacity-40">
                    <x-icon-regular.angle-left class="size-4" />
                    Nazaj
                </span>
            @elseif ($isCursorPaginator)
                <button
                    type="button"
                    wire:click="setPage('{{ $paginator->previousCursor()->encode() }}', '{{ $paginator->getCursorName() }}')"
                    x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    wire:loading.attr="disabled"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                >
                    <x-icon-regular.angle-left class="size-4" />
                    Nazaj
                </button>
            @else
                <button
                    type="button"
                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                    x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    wire:loading.attr="disabled"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                >
                    <x-icon-regular.angle-left class="size-4" />
                    Nazaj
                </button>
            @endif

            @if (($isCursorPaginator && $paginator->nextCursor() === null) || (! $isCursorPaginator && ! $paginator->hasMorePages()))
                <span class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground opacity-40">
                    Naprej
                    <x-icon-regular.angle-right class="size-4" />
                </span>
            @elseif ($isCursorPaginator)
                <button
                    type="button"
                    wire:click="setPage('{{ $paginator->nextCursor()->encode() }}', '{{ $paginator->getCursorName() }}')"
                    x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    wire:loading.attr="disabled"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                >
                    Naprej
                    <x-icon-regular.angle-right class="size-4" />
                </button>
            @else
                <button
                    type="button"
                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                    x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    wire:loading.attr="disabled"
                    class="flex flex-1 items-center justify-center gap-2 rounded-xl border border-border bg-card px-4 py-3 text-sm font-semibold text-muted-foreground transition-all hover:border-teal-200 hover:text-foreground"
                >
                    Naprej
                    <x-icon-regular.angle-right class="size-4" />
                </button>
            @endif
        </div>
    </nav>
@endif
