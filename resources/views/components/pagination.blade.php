@props(['paginator'])

@if ($paginator instanceof \Illuminate\Contracts\Pagination\Paginator && $paginator->hasPages())
    <nav class="flex items-center justify-between mt-8" role="navigation" aria-label="Pagination">
        <div class="flex-1 flex justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default rounded-md">Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-rose-900 bg-white border border-slate-200 rounded-md hover:bg-rose-50">Anterior</a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-rose-900 bg-white border border-slate-200 rounded-md hover:bg-rose-50">Siguiente</a>
            @else
                <span class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default rounded-md">Siguiente</span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-slate-600">
                    Mostrando
                    @if($paginator->firstItem() && $paginator->lastItem())
                        <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                        -
                        <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-semibold">{{ $paginator->count() }}</span>
                    @endif
                    @if(method_exists($paginator, 'total'))
                        de
                        <span class="font-semibold">{{ $paginator->total() }}</span>
                        resultados
                    @endif
                </p>
            </div>
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default rounded-l-md">
                            <span class="sr-only">Anterior</span>
                            ‹
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-rose-900 bg-white border border-slate-200 hover:bg-rose-50 rounded-l-md">
                            <span class="sr-only">Anterior</span>
                            ‹
                        </a>
                    @endif

                    @if ($paginator instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        @php $totalPages = $paginator->lastPage(); @endphp
                        @for ($page = 1; $page <= $totalPages; $page++)
                            @if ($page == $paginator->currentPage())
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-rose-900 border border-rose-900">{{ $page }}</span>
                            @else
                                <a href="{{ $paginator->url($page) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-rose-900 bg-white border border-slate-200 hover:bg-rose-50 focus:z-10">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200">
                            Página {{ $paginator->currentPage() }}
                        </span>
                    @endif

                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-rose-900 bg-white border border-slate-200 hover:bg-rose-50 rounded-r-md">
                            <span class="sr-only">Siguiente</span>
                            ›
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-200 cursor-default rounded-r-md">
                            <span class="sr-only">Siguiente</span>
                            ›
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
