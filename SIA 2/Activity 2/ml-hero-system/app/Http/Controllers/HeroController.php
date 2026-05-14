<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Hero;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class HeroController extends Controller
{
    private function getHeroes()
    {
        return collect([
            (object)[
                'id' => 1,
                'name' => 'Arlott',
                'role' => 'Fighter/Assassin',
                'playstyle' => 'Charge/Burst',
                'image' => 'arlott.jpg',
                'difficulty' => 'High',
                'description' => 'A cold-blooded demon hunter who wields a dual-headed spear.'
            ],
            (object)[
                'id' => 2,
                'name' => 'Floryn',
                'role' => 'Support',
                'playstyle' => 'Guard/Heal',
                'image' => 'floryn.jpg',
                'difficulty' => 'Low',
                'description' => 'A kind-hearted girl who brings life and healing to her allies.'
            ],
            (object)[
                'id' => 3,
                'name' => 'Fredrinn',
                'role' => 'Tank/Fighter',
                'playstyle' => 'Damage/Chase',
                'image' => 'fredrinn.jpg',
                'difficulty' => 'Medium',
                'description' => 'A wealthy adventurer who uses his strength and treasure to dominate the battlefield.'
            ],
            (object)[
                'id' => 4,
                'name' => 'Joy',
                'role' => 'Assassin',
                'playstyle' => 'Chase/Damage',
                'image' => 'joy.jpg',
                'difficulty' => 'High',
                'description' => 'A nimble Leonin who dances through the battlefield with musical precision.'
            ],
            (object)[
                'id' => 5,
                'name' => 'Novaria',
                'role' => 'Mage',
                'playstyle' => 'Burst/Poke',
                'image' => 'novaria.jpg',
                'difficulty' => 'Medium',
                'description' => 'A star-gazer who manipulates the cosmos to strike from afar.'
            ],
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $heroes = $this->getHeroes();

        if ($search) {
            $heroes = $heroes->filter(function ($hero) use ($search) {
                return str_contains(strtolower($hero->name), strtolower($search)) ||
                       str_contains(strtolower($hero->role), strtolower($search)) ||
                       str_contains(strtolower($hero->playstyle), strtolower($search));
            });
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentItems = $heroes->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $heroes = new LengthAwarePaginator(
            $currentItems,
            $heroes->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('heroes.index', compact('heroes'));
    }

    public function show($id)
    {
        $hero = $this->getHeroes()->firstWhere('id', (int)$id);

        if (!$hero) {
            abort(404);
        }

        return view('heroes.show', compact('hero'));
    }
}