@extends('site.layouts.index')

@section('content')

    @if (isset($projetos) && count($projetos) > 0)
    <section>
        <div class="img-grid spacious">
            <div class="item-sizer">

            </div>
            @foreach ($projetos as $projeto)
            <a href="/portfolio/{{$projeto->slug}}" data-caption="{{$projeto->titulo}}" class="item"> <!-- lightbox -->
                <img src="{{$projeto->img_src}}">
            </a>
            @endforeach
        </div>
    </section>
    @endif

@endsection
