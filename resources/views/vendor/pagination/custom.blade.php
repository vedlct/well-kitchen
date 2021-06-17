<style>
    .pro-pagination-style ul li {
        display: inline-block;
        margin: 0 4px;
    }

    .pro-pagination-style ul li a {
        display: inline-block;
        width: 43px;
        height: 43px;
        text-align: center;
        line-height: 43px;
        font-size: 16px;
        border-radius: 100%;
        color: #ed1c24;
        -webkit-box-shadow: 0 0px 12px 0.8px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0px 12px 0.8px rgba(0, 0, 0, 0.1);
    }

    .pro-pagination-style ul li a:hover {
        background-color: #ed1c24;
        color: #fff;
    }

    .pro-pagination-style ul li a.active {
        background-color: #ed1c24;
        color: #fff;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .pro-pagination-style ul li a.active:hover {
        background-color: #333;
    }

    .pro-pagination-style ul li a.prev,
    .pro-pagination-style ul li a.next {
        background-color: #f6f6f6;
        color: #ed1c24;
        font-size: 17px;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .pro-pagination-style ul li a.prev:hover,
    .pro-pagination-style ul li a.next:hover {
        background-color: #ed1c24;
        color: #fff;
    }

</style>

@if ($paginator->hasPages())

<ul class="pager">

    @if ($paginator->onFirstPage())
    <li><a class="prev" href="javascript:void(0)"><i class="fa fa-angle-double-left"></i></a></li>
    {{--  <li class="disabled"><span>← Previous</span></li>  --}}
    @else
    <li><a class="prev" href="javascript:void(0)"><i class="fa fa-angle-double-left"></i></a></li>
    {{--  <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li> --}}
    @endif



    @foreach ($elements as $element)
    @if (is_string($element))
    <li class="disabled"><span>{{ $element }}</span></li>
    @endif



    @if (is_array($element))
{{--        {{dd($paginator->url())}}--}}
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li><a class="active" href="javascript:void(0)">{{ $page }}</a></li>
    {{--  <li class="active my-active"><span>{{ $page }}</span></li>  --}}
    @else
    <li><a href="{{ $url }}" class="page" data-page_id="{{$page}}">{{ $page }}</a></li>
    {{--  <li><a href="{{ $url }}">{{ $page }}</a></li>  --}}
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li><a class="next" href="javascript:void(0)"><i class="fa fa-angle-double-right"></i></a></li>
    {{--  <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>  --}}
    @else
    <li><a class="next" href="javascript:void(0)"><i class="fa fa-angle-double-right"></i></a></li>
    {{--  <li class="disabled"><span>Next →</span></li>  --}}
    @endif
</ul>
@endif
