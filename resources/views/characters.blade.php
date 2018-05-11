@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="d-none d-sm-block">もう誰も横浜の果てで涙という名の同窓会だけ見えない　キャラクターシート保管庫</h1>
        <h5 class="d-sm-none">もう誰も横浜の果てで涙という名の同窓会だけ見えない　キャラクターシート保管庫</h5>
        <div class="row">
            <div class="col-4 mb-3">
                <a href="{{ url('/actor') }}" class="btn btn-secondary py-1">新規作成</a>
            </div>
        </div>
    </div>
    <div class="container character-list">
        <div class="row justify-content-center">
            <div class="col-2 panel-heading">No</div>
            <div class="col-5 panel-heading">アクター名</div>
            <div class="col-5 panel-heading">プレイヤー名</div>
        </div>
        @foreach ($characters as $c)
        <div class="row justify-content-center panel panel-default">
            <div class="col-2 panel-body">{{ $c->id }}</div>
            <div class="col-5 panel-body"><a href="{{ url('actor')."/".$c->id_rand }}">{{ null_escape($c->actor_name, '名称未設定') }}</a></div>
            <div class="col-5 panel-body"><a href="{{ url('player')."/".$c->uid }}">{{ $c->player_name }}</a></div>
        </div>
        @endforeach
        {{ $characters->links() }}

    </div>

@endsection

