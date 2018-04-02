@extends('layouts.site')

@section('header')
    @include('site.header')
@endsection

@section('content')
    @if(isset($data))
        <div class="container">
            @foreach($data as $value)
                <div class="row">
                    <h1 style="text-align: center; text-transform: uppercase">{{ $value->name }}</h1>
                    <div class="col-md-3">
                        {!! Html::image('assets/img/'.$value->images) !!}
                    </div>
                    <div class="col-md-9">
                        {!! $value->text !!}
                    </div>
                </div>
            @endforeach
                <a href="{{ route('home') }}" class="btn btn-success">На головну</a>
        </div>
    @endif

@endsection