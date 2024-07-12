<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PokemonController extends Controller
{
    public function strongestPokemon()
    {
        $client = new Client();
        $response = $client->get('https://pokeapi.co/api/v2/pokemon?limit=10');
        $pokemonData = json_decode($response->getBody(), true);
        $pokemon = [];
        foreach ($pokemonData['results'] as $result) {
            $response = $client->get($result['url']);
            $data = json_decode($response->getBody(), true);
            $pokemon[] = [
                'name' => $data['name'],
                'strength' => $data['stats'][4]['base_stat'],
            ];
        }

        usort($pokemon, function ($a, $b) {
            return $b['strength'] <=> $a['strength'];
        });

        $strongestPokemon = array_slice($pokemon, 0, 10);

        usort($strongestPokemon, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return response()->json($strongestPokemon);
    }
}
