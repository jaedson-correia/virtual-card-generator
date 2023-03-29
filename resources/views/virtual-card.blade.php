@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Hello, my name is {{$card->name}}</h1>
            </div>
        </div>
        @if ($card->extra)
            <div class="row">
                <div class="col">
                    {!! $card->extra !!}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col d-flex gap-3">
                <a target="__blank" href="{{ $card->github }}" class="btn btn-lg btn-light border-dark border">Github</a>
                <a target="__blank" href="{{ $card->linkedin }}" class="btn btn-lg btn-light border-dark border">LinkedIn</a>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-light position-absolute bottom-0 end-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 11h2v2H3v-2m8-6h2v4h-2V5m-2 6h4v4h-2v-2H9v-2m6 0h2v2h2v-2h2v2h-2v2h2v4h-2v2h-2v-2h-4v2h-2v-4h4v-2h2v-2h-2v-2m4 8v-4h-2v4h2M15 3h6v6h-6V3m2 2v2h2V5h-2M3 3h6v6H3V3m2 2v2h2V5H5M3 15h6v6H3v-6m2 2v2h2v-2H5Z"/></svg>
    </button>
@endsection
