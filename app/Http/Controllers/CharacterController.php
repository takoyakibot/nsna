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
        if (empty($character->id_rand)) $character->id_rand = str_random(20);

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
}
