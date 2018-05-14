@extends('layouts.app')

@section('content')

    <div class="container character-list">

        <div class="mb-3 text-center">
            <img src="{{ url(env('APP_IMG')) }}">
        </div>

        <div class="my-3 text-muted">現在、画像アップロードが本番環境でのみなんかうまくいかないという運命濁流表に飲み込まれております……</div>

        <div class="row mb-3">
            <div class="col-6">
                {{ $characters->links() }}
            </div>
            <div class="col-6 text-right">
                <a href="{{ url('/actor') }}" class="btn btn-warning py-1">新規作成</a>
            </div>
        </div>


        <div class="card-columns">
            @foreach ($characters as $c)
            <div class="card">
                <a href="{{ url('/actor/'.$c->id_rand) }}">
                    <img class="card-img-top" src="{{ url(null_escape($c->photo, 'img/nsna2.png')) }}" @if (! $c->photo) style="opacity: 0.3;" @endif>
                    <div class="card-header text-center">
                        <h4 class="card-title text-dark mb-0">{{ null_escape($c->player_name, '近日公開') }}</h4>
                        <p class="card-text text-dark">{{ null_escape($c->actor_name, '近日公開') }} 役</p>
                    </div>
                </a>
                <div class="card-footer text-right text-muted py-1">
                    {{ null_escape($c->created_at->format('Y/m/d')) }} 公開
                </div>
            </div>
            @endforeach
        </div>

    </div>

@endsection

