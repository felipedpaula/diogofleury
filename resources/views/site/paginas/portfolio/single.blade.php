@extends('site.layouts.index')

@section('content')
    <section>
        <div class="container mb-xl mt-lg">
            <div class="content row">
                <h1>{{ $projeto->titulo}}</h1>
                <div class="projeto-details mt-lg mb-lg">
                    {{ $projeto->resumo }}
                </div>
                <div class="projeto-details">
                    {!! $projeto->conteudo !!}
                </div>
            </div>
        </div>

        @if (isset($imagens) && count($imagens) > 0)
        <div class="img-grid spacious">
            <div class="item-sizer">

            </div>
            @foreach ($imagens as $imagem)
            <a href="{{$imagem->src}}" data-caption="{{$imagem->titulo}}" class="item lightbox"> <!-- lightbox -->
                <img src="{{$imagem->src}}">
            </a>
            @endforeach
        </div>
        @endif
    </section>

@endsection
