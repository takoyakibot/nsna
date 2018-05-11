@extends('layouts.app')

@section('content')

    <div class="container character-list">
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
                <a href="{{ url('actor').'/'.$c->id_rand }}">
                    <img class="card-img-top" src="{{ url(null_escape($c->photo, 'img/nsna.png')) }}">
                    <div class="card-header text-dark">
                        <h4 class="card-title mb-0">{{ null_escape($c->actor_name, '名称未設定') }}</h4>
                    </div>
                </a>
                <div class="card-body">
                    <p class="card-text">
                        演者：{{ $c->player_name }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>

@endsection

