@extends('site.layouts.index')

@section('content')

    <ul class="img-scroller fs">
        @foreach ($destaques_home as $item)
        <li class="active vcenter">
            <div class="item lightbox">
                <figure class="legenda-destaque-home">
                    @if ($item->video_src != '' || $item->video_src != null)
                    <video autoplay loop muted>
                        <source src="{{ asset($item->video_src) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @else
                    <img src="{{$item->img_src}}" alt="{{$item->titulo}}">
                    @endif
                    <figcaption>{{$item->titulo}}</figcaption>
                    @if (isset($item->txt_link) && $item->txt_link != '')
                    <a href="{{$item->url_link}}">{{$item->txt_link}}</a>
                    @endif
                </figure>
            </div>
        </li>
        @endforeach
    </ul>

    @if (isset($destaques_home) && count($destaques_home) > 1)
    <script defer src="{{asset('template/modules/img-scroller/img-scroller.js')}}"></script>
    @endif

@endsection
