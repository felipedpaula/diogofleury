@extends('site.layouts.index')

@section('content')

    <ul class="img-scroller fs">
        @foreach ($destaques_home as $item)
        <li class="active vcenter">
            <div class="item lightbox">
                <figure class="legenda-destaque-home">
                    <img src="{{$item->img_src}}" alt="{{$item->titulo}}">
                    <figcaption>{{$item->titulo}}</figcaption>
                    @if (isset($item->txt_link) && $item->txt_link != '')
                    <a href="{{$item->url_link}}">{{$item->txt_link}}</a>
                    @endif
                </figure>
            </div>
        </li>
        @endforeach
    </ul>

    <script src="{{asset('template/modules/img-scroller/img-scroller.js')}}"></script>

@endsection
