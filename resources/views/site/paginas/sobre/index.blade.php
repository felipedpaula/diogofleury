@extends('site.layouts.index')

@section('content')

    <div class="container mb-xl mt-lg">
        <div class="content row">
            <div class="col-md-offset-3 col-md-6">
                <h2>{{$sobre->titulo}}</h2>
                <img src="{{$sobre->img_src}}">
                {!! $sobre->conteudo !!}
            </div>
        </div>
    </div>

@endsection
