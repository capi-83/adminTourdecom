<?php

namespace App\Http\Controllers;

use App\Repositories\CommanderMixRepository;
use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;

class CommanderMixController extends Controller
{

    protected $commanderMixRepository;
    const NB_TIRAGE = 4;
    const PLAYER_MIN = 4;
    const PLAYER_MAX = 10;

    public function __construct(CommanderMixRepository $commanderMixRepository)
    {
        $this->commanderMixRepository = $commanderMixRepository;
    }

    public function show()
    {
        $playerMin = self::PLAYER_MIN;
        $playerMax = self::PLAYER_MAX;
        return view('commanderMix', compact('playerMin', 'playerMax'));
    }

    public function gamble(int $nbplayer)
    {
        if ($nbplayer > 3 && $nbplayer < 11)
        {
            $commanderMix = $this->getCommander($nbplayer);
        } else {
            $commanderMix = []; //erreur nbplayer < 4 ou > 10
        }
        return [
            'html' => view('resultCommanderMix', compact('commanderMix', 'nbplayer'))->render(),
        ];
        //ddd($commanderMix);
        //return view('resultCommanderMix', compact('commanderMix', 'nbplayer'));
    }

    private function getCommander(int $nbplayer)
    {
        $allCommander = $this->commanderMixRepository->getAll();
        //ddd($allCommander);
        $numberCommander = $this->commanderMixRepository->getNumberCommander();
        $tab = [];
        $tabNumber = [];
        for ($n = 1; $n <= $numberCommander; $n++)
        {
            $tabNumber[] = $n;
        }
        shuffle($tabNumber);
        $x = 0;
        for ($i = 0; $i < $nbplayer; $i++)
        {
            $tab[$i] = [];
            $tirage = [];
            for ($y = 0; $y < self::NB_TIRAGE; $y++)
            {
                //ddd($this->commanderMixRepository->getById($tabNumber[$x]));
                $tirage[] = $this->commanderMixRepository->getById($tabNumber[$x]);
                $x++;
            }
            //ddd($tirage);
            $tab[$i] = $tirage;
        }
        return $tab;
    }
}
