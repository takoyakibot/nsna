@php
$good = 12;
$evil = 12;
$social = 17;
foreach ($ore as $item)
{
    $good += $item->good;
    $evil += $item->evil;
    $social += $item->social;
}

// 俺表自由入力欄
$ore_free_list = [
    $character->omote1_free,
    $character->omote2_free,
    $character->ura1_free,
    $character->ura2_free,
    $character->ura3_free,
    $character->ura4_free,
];
$ore_footer_list = ['で、','。','で、','し、','だし、','。',];
$ore_sample_list = ['保険の調査員','歴史に詳しい','大学の考古学者','奇抜な説を提唱して白い目で見られている','親子揃ってバツイチ','このあいだ娘夫婦も離婚した',];

// 殺すリスト
$kill_head_list = ['主席','次席','３位','４位','５位',];
$kill_list = [
    $character->kill1,
    $character->kill2,
    $character->kill3,
    $character->kill4,
    $character->kill5,
];
@endphp

@extends('layouts.app')

@section('content')
<form action="{{ url('actor/').$character->id_rand }}" method="post">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="container">
        <h1>もう誰も横浜の果てで涙という名の同窓会だけ見えないRPG</h1>

        <div class="form-group row actor-row">
            <div class="col-md-8 order-2">
                <div class="row actor-row px-1">
                    <label for="player_name" class="col-form-label col-4 mb-1">プレイヤー名</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="player_name" class="form-control no-border" value="{{ old('player_name', null_escape($character->player_name)) }}"></div>
                    <label for="actor_name" class="col-form-label col-4 mb-1">アクター名</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="actor_name" class="form-control no-border" value="{{ old('actor_name', null_escape($character->actor_name)) }}"></div>
                    <label for="organization" class="col-form-label col-4 mb-1">所属</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="organization" class="form-control no-border" value="{{ old('actor_name', null_escape($character->organization)) }}"></div>
                    <label for="age" class="col-form-label col-4 mb-1">年齢</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="age" class="form-control no-border" value="{{ old('age', null_escape($character->age)) }}"></div>
                    <label for="gender" class="col-form-label col-4 mb-3">性別</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="gender" class="form-control no-border" value="{{ old('gender', null_escape($character->gender)) }}"></div>

                    <label for="good" class="col-form-label col-4 mb-1">良心</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1 mb-1">
                        <label class="col-form-label col-12 my-0 text-center no-border bg-white">
                            現在値：<select name="good" style="font-size: small;">
                                @for ($i = 0; $i <= 24; $i++) <option value="{{ $i }}" @if ($i == null_escape($character->good, $good)) selected @endif>{{ $i }}</option> @endfor
                            </select>
                            　/　初期値：{{ $good }}
                        </label>
                    </div>
                    <label for="evil" class="col-form-label col-4 mb-1">邪心</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1 mb-1">
                        <label class="col-form-label col-12 my-0 text-center no-border bg-white">
                            現在値：<select name="evil" style="font-size: small;">
                                @for ($i = 0; $i <= 24; $i++) <option value="{{ $i }}" @if ($i == null_escape($character->evil, $evil)) selected @endif>{{ $i }}</option> @endfor
                            </select>
                            　/　初期値：{{ $evil }}
                        </label>
                    </div>
                    <label for="social" class="col-form-label col-4 mb-3">社会信用度</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1 mb-3">
                        <label class="col-form-label col-12 my-0 text-center no-border bg-white">
                            現在値：<select name="social" style="font-size: small;">
                                @for ($i = 0; $i <= 33; $i++) <option value="{{ $i }}" @if ($i == null_escape($character->social, $social)) selected @endif>{{ $i }}</option> @endfor
                            </select>
                            　/　初期値：{{ $social }}
                        </label>
                    </div>

                    <label for="must_important" class="col-form-label col-4 mb-1 overflow">最も大切な人（物）</label>
                    <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="must_important" class="form-control no-border" value="{{ old('must_important', null_escape($character->must_important)) }}"></div>
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-9">
                <div class="row px-1 mb-3">
                    <label for="photo" class="col-form-label col-12 mb-1 no-border bg-light text-center">在りし日の写真</label>
                    <label class="col-form-label col-12 mb-1 no-border bg-light text-center">
                        <img src="{{ null_escape($character->photo, url('img/hansei_koukai_woman.png')) }}" class="my-1 bg-white" style="min-width: 100px; min-height: 100px;">
                    </label>
                    <label class="col-12 col-form-label text-right"><span class="btn btn-info py-1">写真を飾る<input type="file" style="display:none;"></span></label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 px-1 mb-1">
                <div class="card">
                    <div class="card-header">メモ</div>
                    <div class="card-body">
                        <div class="card-text row">
                            <textarea name="memo" class="form-control" style="min-height: 100px;">{{ old('memo', null_escape($character->memo)) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 px-3">
                <div class="row">
                    <div class="col-3 col-md-4"></div>
                    <div class="col-6 col-md-4 text-right mb-1">
                        <input type="submit" class="btn @if (empty($character->omote_id1)) btn-warning @else btn-secondary @endif form-control py-1" name="getOre" value="表の顔・裏の顔を決める" @if (! empty($character->omote_id1)) disabled @endif>
                    </div>
                    <div class="col-3 col-md-4"></div>
                </div>
            </div>
            <div class="col-12 col-md-6 px-1 mb-1">
                <div class="card">
                    <div class="card-header bg-light">表の顔</div>
                    <div class="card-body">
                        <div class="card-text">
                            @foreach ([0, 1] as $i)
                            <p><i>{{ null_escape($ore[$i]->text1, $ore_sample_list[$i]) }}
                            @if (! empty($ore[$i]->text2))
                            <input type="text" name="{{ 'omote'.($i+1).'_free' }}" value="{{ old('omote'.($i+1).'_free', null_escape($ore_free_list[$i])) }}">
                            {{ null_escape($ore[$i]->text2) }}
                            @endif
                            </i> {{ $ore_footer_list[$i] }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 px-1 mb-1">
                <div class="card">
                    <div class="card-header bg-dark text-white">裏の顔</div>
                    <div class="card-body">
                        <div class="card-text">
                            @foreach ([2, 3, 4, 5] as $i)
                            <p><i>{{ null_escape($ore[$i]->text1, $ore_sample_list[$i]) }}
                            @if (! empty($ore[$i]->text2))
                            <input type="text" name="{{ 'ura'.($i+1).'_free' }}" value="{{ old('ura'.($i+1).'_free', null_escape($ore_free_list[$i])) }}">
                            {{ null_escape($ore[$i]->text2) }}
                            @endif
                            </i> {{ $ore_footer_list[$i] }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 px-1 mb-1">
                <div class="card">
                    <div class="card-header bg-danger text-white">『殺ス』リスト</div>
                    <div class="card-body bg-dark">
                        <div class="card-text row">
                            @foreach ([0,1,2,3,4] as $i)
                            <label class="col-form-label col-4 mb-1 text-center no-border bg-light">{{ $kill_head_list[$i] }}</label>
                            <div class="col-8 pl-1 pr-0"><input type="text" class="form-control no-border" name="{{ 'kill'.($i+1) }}" value="{{ old('kill'.($i+1), null_escape($kill_list[$i])) }}"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12 px-3">
                <div class="row">
                    <div class="col-3 col-md-4"></div>
                    <div class="col-6 col-md-4 text-right mb-1">
                        <input type="submit" class="btn btn-primary form-control py-1" name="save" value="保存">
                    </div>
                    <div class="col-3 col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

