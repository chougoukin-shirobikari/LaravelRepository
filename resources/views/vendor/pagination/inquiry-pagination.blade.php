@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a id="link_inquiry" class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            {{-- 定数よりもページ数が多い時 --}}
            @if($paginator->lastPage() > Consts::INQUIRY_PER_PAGE)

                {{-- 現在ページが表示するリンクの中心位置よりも左の時 --}}
                @if($paginator->currentPage() <= floor(3 / 2))
                    <?php $start_page = 1; //最初のページ ?>
                    <?php $end_page = Consts::INQUIRY_PER_PAGE; ?>

                {{-- 現在ページが表示するリンクの中心位置よりも右の時 --}}
                @elseif($paginator->currentPage() > $paginator->lastPage() - floor(Consts::INQUIRY_PER_PAGE / 2) )
                    <?php $start_page = $paginator->lastPage() - (Consts::INQUIRY_PER_PAGE - 1); ?>
                    <?php $end_page = $paginator->lastPage(); ?>

                {{-- 現在ページが表示するリンクの中心位置の時 --}}
                @else
                    <?php $start_page = $paginator->currentPage() - (floor(Consts::INQUIRY_PER_PAGE % 2 == 0 ? Consts::INQUIRY_PER_PAGE - 1 : Consts::INQUIRY_PER_PAGE / 2)); ?>
                    <?php $end_page = $paginator->currentPage() + floor(Consts::INQUIRY_PER_PAGE / 2); ?>
                @endif

            {{-- 定数よりもページが少ない時 --}}
            @else
                <?php $start_page = 1; ?>
                <?php $end_page = $paginator->lastPage(); ?>
            @endif

            {{-- 処理部分 --}}
            @for($i = $start_page; $i <= $end_page; $i++)
                @if($i == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a id="link_inquiry" class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a id="link_inquiry" class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
