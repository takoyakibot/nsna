<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;
use App\Ore;
use League\Flysystem\Exception;

class CharacterController extends Controller
{
    protected function index()
    {
        $characters = Character::orderBy('id', 'desc')->paginate(10);
        return view('characters', compact('characters'));
    }

    /**
     * return Actor View with Actor Data.
     * If new Acter, then return Freshman.
     *
     * @param $id_rand
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id_rand = '')
    {
        $character = null_escape(Character::where('id_rand', $id_rand)->first(), new Character);
        if (empty($character->id_rand))
        {
            $character->id_rand = str_random(20);

            //表の「〜の〜で」|101〜118
            //表の「。」|201〜212
            //裏の「〜の〜で」|301〜318
            //裏の「し・だし・。」|401〜436
            $character->omote1_id = rand(101, 118);
            $character->omote2_id = rand(201, 212);
            $character->ura1_id = rand(301, 318);
            $character->ura2_id = rand(401, 436);
            $character->ura3_id = rand(401, 436);
            $character->ura4_id = rand(401, 436);}

        return view('actor')->with([
            'character' => $character,
            'ore' => $this->getOre($character),
        ]);
    }

    /**
     * Get 8 Data From Ore Table.
     * if Unset oreId, then return null.
     *
     * @param $character
     * @return array
     */
    private function getOre($character)
    {
        return [
            null_escape(Ore::where('ore_id', $character->omote1_id)->first(), new Ore),
            null_escape(Ore::where('ore_id', $character->omote2_id)->first(), new Ore),
            null_escape(Ore::where('ore_id', $character->ura1_id)->first(), new Ore),
            null_escape(Ore::where('ore_id', $character->ura2_id)->first(), new Ore),
            null_escape(Ore::where('ore_id', $character->ura3_id)->first(), new Ore),
            null_escape(Ore::where('ore_id', $character->ura4_id)->first(), new Ore),
        ];
    }

    protected function submit(Request $request, $id_rand = '')
    {
        $character = null_escape(Character::where('id_rand', $id_rand)->first(), new Character);

        // $character情報を更新する
        if (empty($character->id_rand)) $character->id_rand = $id_rand;
        $character->password_hash = $request->password_hash;
        $character->player_name = $request->player_name;
        $character->actor_name = $request->actor_name;
        $character->organization = $request->organization;
        $character->age = $request->age;
        $character->gender = $request->gender;
        $character->photo = $request->photo;
        $character->good = $request->good;
        $character->evil = $request->evil;
        $character->social = $request->social;
        $character->most_important = $request->most_important;
        $character->omote1_id = $request->omote1_id;
        $character->omote1_free = $request->omote1_free;
        $character->omote2_id = $request->omote2_id;
        $character->omote2_free = $request->omote2_free;
        $character->ura1_id = $request->ura1_id;
        $character->ura1_free = $request->ura1_free;
        $character->ura2_id = $request->ura2_id;
        $character->ura2_free = $request->ura2_free;
        $character->ura3_id = $request->ura3_id;
        $character->ura3_free = $request->ura3_free;
        $character->ura4_id = $request->ura4_id;
        $character->ura4_free = $request->ura4_free;
        $character->kill1 = $request->kill1;
        $character->kill2 = $request->kill2;
        $character->kill3 = $request->kill3;
        $character->kill4 = $request->kill4;
        $character->kill5 = $request->kill5;
        $character->memo = $request->memo;

        $character->save();

        return redirect('/actor/'.$character->id_rand);
    }

}