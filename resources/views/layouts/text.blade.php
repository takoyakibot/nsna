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

プレイヤー：{{ null_escape($character->player_name) }}<br>
アクター：{{ null_escape($character->actor_name) }}<br>
所属：{{ old('actor_name', null_escape($character->organization)) }}<br>
年齢：{{ old('age', null_escape($character->age)) }}<br>
性別：{{ old('gender', null_escape($character->gender)) }}<br>
<br>
良心：{{ null_escape($character->good) }}<br>
邪心：{{ null_escape($character->evil) }}<br>
社会信用度：{{ null_escape($character->social) }}<br>
<br>
最も大切な人（物）：{{ null_escape($character->most_important) }}<br>
<br>
表の顔：<br>
@foreach ([0,1] as $i){{ null_escape($ore[$i]->text1) }}@if (! empty($ore[$i]->text2)) {{ old('omote'.($i+1).'_free', null_escape($ore_free_list[$i])) }}{{ null_escape($ore[$i]->text2) }} @endif {{ $ore_footer_list[$i] }}<br>
@endforeach
<br>
裏の顔：<br>
@foreach ([2,3,4,5] as $i){{ null_escape($ore[$i]->text1) }}@if (! empty($ore[$i]->text2)){{ old('ura'.($i-1).'_free', null_escape($ore_free_list[$i])) }}{{null_escape($ore[$i]->text2) }} @endif {{ $ore_footer_list[$i] }}</p>
@endforeach
<br>
『殺ス』リスト<br>
@foreach ([0,1,2,3,4] as $i){{ $kill_head_list[$i] }}：{{ null_escape($kill_list[$i]) }}<br>@endforeach
<br>
メモ<br>
{{ null_escape($character->memo) }}<br>
<br>
@endsection

