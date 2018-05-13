@php
$title = null_escape($character->actor_name, '近日公開');
$good = 12;
$evil = 12;
$social = 17;
foreach ($ore as $item)
{
    $good += $item->good;
    $evil += $item->evil;
    $social += $item->social;
}
// 最大値は超えない
if ($good > 24) $good = 24;
if ($evil > 24) $evil = 24;
if ($social > 33) $social = 33;

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
<script src="{{ asset('js/sha256.js') }}" defer></script>
<script>
    $(function(){
        // ページ離脱イベント
        $(window).on('beforeunload',function(){
            return('ページ移動を確認します');
        });
        // Submitの場合のみ　ページ離脱イベント解除
        $('form').on('submit',function(){
            $(window).off('beforeunload');
        });
        // Enterキーのsubmitを無効
        $("input").on("keydown", function(e) {
            if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
                return false;
            } else {
                return true;
            }
        });
    });
</script>
<script type="text/javascript">
    function checkPassword ()
    {
        try
        {
            // passwordを取得
            var p = document.f.password.value;

            // 空文字でなければハッシュ値を生成
            if (p != '') document.f.password_hash.value = getHash(p);

            var current_password = '{{ $character->password_hash }}';

            // 現在のパスワードが空なら何が来てもtrue（パスワードは新しいものに変わる）
            if (current_password == '' || current_password == document.f.password_hash.value)
            {
                // パスワードはPOSTさせない
                document.f.password.value = '';

                alert('保存するです');

                return true;
            }

            alert('パスワードが違います');
            return false;
        }
        catch (e)
        {
            console.log(e);
            alert('やばい');
        }
        return false;
    }

    function getHash(str)
    {
        var shaObj = new jsSHA("SHA-256", "TEXT");
        shaObj.update(str);
        var hash = shaObj.getHash("HEX");
        return hash;
    }

    // 画像プレビュー
    function photoKazaru(file)
    {
        document.f.photo.src = window.URL.createObjectURL(file);
        if (file.size > 100000) alert('保存されるファイルサイズの上限は約100KBです。');

//        var fileReader = new FileReader();
//        fileReader.onload = function () {
//            if (this.result.length > 300000) alert("でかない？");
//            else document.f.photo_data_uri.value = this.result;
//        }
//        fileReader.readAsDataURL(file)
    }
</script>

<form action="{{ url('actor/'.$character->id_rand) }}" method="post" name="f" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="container">
        <h1>もう誰も横浜の果てで涙という名の同窓会だけ見えないRPG</h1>
        <p class="text-muted">※新規作成時にリロードすると表の顔・裏の顔は変更されます。<br>
        <a href="{{ url('/actor/'.$character->id_rand.'/text/') }}">テキスト表示</a>（データの保存が必要です）</p>

        <div class="px-3">
            <div class="form-group row actor-row">
                <div class="col-md-8 order-2">
                    <div class="row actor-row px-1">

                        {{--パーソナルデータ--}}
                        <label for="player_name" class="col-form-label col-4 mb-1 overflow">プレイヤー名</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="player_name" class="form-control no-border" value="{{ old('player_name', null_escape($character->player_name)) }}"></div>
                        <label for="actor_name" class="col-form-label col-4 mb-1 overflow">アクター名</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="actor_name" class="form-control no-border" value="{{ old('actor_name', null_escape($character->actor_name)) }}"></div>
                        <label for="organization" class="col-form-label col-4 mb-1">所属</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="organization" class="form-control no-border" value="{{ old('actor_name', null_escape($character->organization)) }}"></div>
                        <label for="age" class="col-form-label col-4 mb-1">年齢</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="age" class="form-control no-border" value="{{ old('age', null_escape($character->age)) }}"></div>
                        <label for="gender" class="col-form-label col-4 mb-3">性別</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="gender" class="form-control no-border" value="{{ old('gender', null_escape($character->gender)) }}"></div>

                        {{--能力値--}}
                        <label for="good" class="col-form-label col-4 mb-1">良心</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1 mb-1">
                            <label class="col-form-label col-12 my-0 text-center no-border bg-white">
                                現在値：<select name="good" style="font-size: small;">
                                    @for ($i = 0; $i <= 24; $i++) <option value="{{ $i }}" @if ($i == null_escape($character->good, $good)) selected @endif>{{ $i }}</option> @endfor
                                </select>
                                <span class="d-none d-md-inline">　/　</span>
                                <span class="d-md-none"><br></span>
                                初期値：{{ $good }}
                            </label>
                        </div>
                        <label for="evil" class="col-form-label col-4 mb-1">邪心</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1 mb-1">
                            <label class="col-form-label col-12 my-0 text-center no-border bg-white">
                                現在値：<select name="evil" style="font-size: small;">
                                    @for ($i = 0; $i <= 24; $i++) <option value="{{ $i }}" @if ($i == null_escape($character->evil, $evil)) selected @endif>{{ $i }}</option> @endfor
                                </select>
                                <span class="d-none d-md-inline">　/　</span>
                                <span class="d-md-none"><br></span>
                                初期値：{{ $evil }}
                            </label>
                        </div>
                        <label for="social" class="col-form-label col-4 mb-3">社会信用度</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1 mb-3">
                            <label class="col-form-label col-12 my-0 text-center no-border bg-white">
                                現在値：<select name="social" style="font-size: small;">
                                    @for ($i = 0; $i <= 33; $i++) <option value="{{ $i }}" @if ($i == null_escape($character->social, $social)) selected @endif>{{ $i }}</option> @endfor
                                </select>
                                <span class="d-none d-md-inline">　/　</span>
                                <span class="d-md-none"><br></span>
                                初期値：{{ $social }}
                            </label>
                        </div>

                        <label for="most_important" class="col-form-label col-4 mb-1 overflow">最も大切な人（物）</label>
                        <div class="col-8 pl-1 pr-0 pr-md-1"><input type="text" name="most_important" class="form-control no-border" value="{{ old('most_important', null_escape($character->most_important)) }}"></div>
                    </div>
                </div>

                {{--在りし日の写真--}}
                <div class="col-12 col-md-4 order-1 order-md-9">
                    <div class="row px-1 mb-3">
                        <label for="photo" class="col-form-label col-12 mb-1 no-border bg-light text-center">在りし日の写真</label>
                        <label class="col-form-label col-12 mb-1 no-border bg-light text-center">
                            <img name="photo" src="{{ url(null_escape($character->photo, 'img/nsna.png')) }}" class="my-1 bg-white">
                        </label>
                        <div class="col-12 text-right">
                            <label class="col-form-label">
                            <span class="btn btn-info py-1">
                                写真を飾る
                                <input id="kazaru" name="kazaru" onchange="photoKazaru(this.files[0]);" type="file" style="display:none;">
                            </span>
                            </label>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            </div>

            <div class="row">

                {{--表の顔・裏の顔--}}
                <div class="col-12 col-md-6 px-1 mb-1">
                    <div class="card">
                        <div class="card-header bg-light">表の顔</div>
                        <div class="card-body">
                            @foreach ([0,1] as $i)
                            <p class="card-text"><i>{{ null_escape($ore[$i]->text1) }}
                            @if (! empty($ore[$i]->text2))
                            <input type="text" name="{{ 'omote'.($i+1).'_free' }}" value="{{ old('omote'.($i+1).'_free', null_escape($ore_free_list[$i])) }}">
                            {{ null_escape($ore[$i]->text2) }}
                            @endif
                            </i> {{ $ore_footer_list[$i] }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 px-1 mb-3">
                    <div class="card">
                        <div class="card-header bg-dark text-white">裏の顔</div>
                        <div class="card-body">
                            @foreach ([2,3,4,5] as $i)
                            <p class="card-text"><i>{{ null_escape($ore[$i]->text1) }}
                            @if (! empty($ore[$i]->text2))
                            <input type="text" name="{{ 'ura'.($i-1).'_free' }}" value="{{ old('ura'.($i-1).'_free', null_escape($ore_free_list[$i])) }}">
                            {{ null_escape($ore[$i]->text2) }}
                            @endif
                            </i> {{ $ore_footer_list[$i] }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <input type="hidden" name="omote1_id" value="{{ $character->omote1_id }}">
                <input type="hidden" name="omote2_id" value="{{ $character->omote2_id }}">
                <input type="hidden" name="ura1_id" value="{{ $character->ura1_id }}">
                <input type="hidden" name="ura2_id" value="{{ $character->ura2_id }}">
                <input type="hidden" name="ura3_id" value="{{ $character->ura3_id }}">
                <input type="hidden" name="ura4_id" value="{{ $character->ura4_id }}">

                {{--さつりく帳--}}
                <div class="col-12 col-md-6 px-1 mb-3">
                    <div class="card">
                        <div class="card-header bg-danger text-white">『殺ス』リスト</div>
                        <div class="card-body bg-dark">
                            <div class="row">
                                @foreach ([0,1,2,3,4] as $i)
                                <label class="col-form-label col-4 mb-1 text-center no-border bg-light">{{ $kill_head_list[$i] }}</label>
                                <div class="col-8 pl-1 pr-0"><input type="text" class="form-control no-border" name="{{ 'kill'.($i+1) }}" value="{{ old('kill'.($i+1), null_escape($kill_list[$i])) }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{--メモ--}}
                <div class="col-12 col-md-6 px-1 mb-3">
                    <div class="card">
                        <div class="card-header">メモ</div>
                        <div class="card-body p-0">
                                <textarea name="memo" class="form-control" style="min-height: 256px; border: 0;">{{ old('memo', null_escape($character->memo)) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{--保存関係--}}
            <div class="row my-5">
                <div class="col-12 px-3">
                    <div class="row mb-1">
                        <div class="col-6 col-md-4 mb-1 px-1">
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                        <div class="col-6 col-md-4 mb-1">
                            <input type="submit" class="btn btn-primary form-control" name="save" value="保存" onclick="return checkPassword();">
                        </div>

                        <input type="hidden" class="form-control" name="password_hash" value="">
                    </div>
                    <div class="row">
                        <div class="col small">※パスワードは入力しないでも保存ができますが、一度入力するとそれ以降同じパスワードの入力が必要になります。</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

