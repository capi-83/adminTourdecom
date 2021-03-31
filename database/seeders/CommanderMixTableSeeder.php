<?php

namespace Database\Seeders;

use App\Models\CommanderMix;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommanderMixTableSeeder extends Seeder
{
    const COLOR_W = 'w';
    const COLOR_U = 'u';
    const COLOR_B = 'b';
    const COLOR_R = 'r';
    const COLOR_G = 'g';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commanderMixtab = 
        [
                [
                    'commander' => 'Armix, Filigree Thrasher',
                    'decklist' => 'https://deckstats.net/decks/42204/1804353-commander-mix-black-armix',
                    'color' => self::COLOR_B
                ],
                [
                    'commander' => 'Falthis, Shadowcat Familiar',
                    'decklist' => 'https://deckstats.net/decks/42204/1804329-commander-mix-black-falthis',
                    'color' => self::COLOR_B
                ],
                [
                    'commander' => 'Keskit, the Flesh Sculptor',
                    'decklist' => 'https://deckstats.net/decks/42204/1804386-commander-mix-black-keskit',
                    'color' => self::COLOR_B
                ],
                [
                   'commander' => 'Miara, Thorn of the Glade',
                    'decklist' => 'https://deckstats.net/decks/42204/1804433-commander-mix-black-miara',
                    'color' => self::COLOR_B
                ],
                [
                    'commander' => 'Nadier, Agent of the Duskenel',
                    'decklist' => 'https://deckstats.net/decks/42204/1804419-commander-mix-black-nadier',
                    'color' => self::COLOR_B
                ],
                [
                    'commander' => 'Sengir, the Dark Baron',
                    'decklist' => 'https://deckstats.net/decks/42204/1804315-commander-mix-black-sengir',
                    'color' => self::COLOR_B
                ],
                [
                    'commander' => 'Tevesh Szat, Doom of Fools',
                    'decklist' => 'https://deckstats.net/decks/42204/1803742-commander-mix-black-tevesh-sza',
                    'color' => self::COLOR_B
                ],
                [
                   'commander' => 'Tormod, the Desecrator',
                    'decklist' => 'https://deckstats.net/decks/42204/1803887-commander-mix-black-tormod',
                    'color' => self::COLOR_B
                ],
                [
                    'commander' => 'Brinelin, the Moon Kraken',
                    'decklist' => 'https://deckstats.net/decks/42204/1803828-commander-mix-blue-brinelin',
                    'color' => self::COLOR_U
                ],
                [
                    'commander' => 'Eligeth, Crossroads Augur',
                    'decklist' => 'https://deckstats.net/decks/42204/1803726-commander-mix-blue-eligeth',
                    'color' => self::COLOR_U
                ],
                [
                    'commander' => 'Esior, Wardwing Familiar',
                    'decklist' => 'https://deckstats.net/decks/42204/1803813-commander-mix-blue-esior',
                    'color' => self::COLOR_U
                ],
                [
                   'commander' => 'Glacian, Powerstone Engineer',
                    'decklist' => 'https://deckstats.net/decks/42204/1804148-commander-mix-blue-glacian',
                    'color' => self::COLOR_U
                ],
                [
                    'commander' => 'Malcolm, Keen-Eyed Navigator',
                    'decklist' => 'https://deckstats.net/decks/42204/1803837-commander-mix-blue-malcolm',
                    'color' => self::COLOR_U
                ],
                [
                    'commander' => 'Ghost of Ramirez DePietro',
                    'decklist' => 'https://deckstats.net/decks/42204/1803831-commander-mix-blue-ramirez',
                    'color' => self::COLOR_U
                ],
                [
                    'commander' => 'Sakashima of a Thousand Faces',
                    'decklist' => 'https://deckstats.net/decks/42204/1803871-commander-mix-blue-sakashima',
                    'color' => self::COLOR_U
                ],
                [
                   'commander' => 'Siani, Eye of the Storm',
                    'decklist' => 'https://deckstats.net/decks/42204/1803855-commander-mix-blue-siani',
                    'color' => self::COLOR_U
                ],
                [
                    'commander' => 'Anara, Wolvid Familiar',
                    'decklist' => 'https://deckstats.net/decks/42204/1804150-commander-mix-green-anara',
                    'color' => self::COLOR_G
                ],
                [
                    'commander' => 'Gilanra, Caller of Wirewood',
                    'decklist' => 'https://deckstats.net/decks/42204/1804864-commander-mix-green-gilanra',
                    'color' => self::COLOR_G
                ],
                [
                    'commander' => 'Halana, Kessig Ranger',
                    'decklist' => 'https://deckstats.net/decks/42204/1803879-commander-mix-green-halana',
                    'color' => self::COLOR_G
                ],
                [
                   'commander' => 'Ich-Tekik, Salvage Splicer',
                    'decklist' => 'https://deckstats.net/decks/42204/1804733-commander-mix-green-ish-tekik',
                    'color' => self::COLOR_G
                ],
                [
                    'commander' => 'Kamahl, Heart of Krosa',
                    'decklist' => 'https://deckstats.net/decks/42204/1804736-commander-mix-green-kamahl',
                    'color' => self::COLOR_G
                ],
                [
                    'commander' => 'Kodama of the East Tree',
                    'decklist' => 'https://deckstats.net/decks/42204/1804808-commander-mix-green-kodama',
                    'color' => self::COLOR_G
                ],
                [
                    'commander' => 'Numa, Joraga Chieftain',
                    'decklist' => 'https://deckstats.net/decks/42204/1804741-commander-mix-green-numa',
                    'color' => self::COLOR_G
                ],
                [
                   'commander' => 'Slurrk, All-Ingesting',
                    'decklist' => 'https://deckstats.net/decks/42204/1804762-commander-mix-green-slurrk',
                    'color' => self::COLOR_G
                ],
                [
                    'commander' => 'Alena, Kessig Trapper',
                    'decklist' => 'https://deckstats.net/decks/42204/1804860-commander-mix-red-alena',
                    'color' => self::COLOR_R
                ],
                [
                    'commander' => 'Breeches, Brazen Plunderer',
                    'decklist' => 'https://deckstats.net/decks/42204/1803850-commander-mix-red-breeches',
                    'color' => self::COLOR_R
                ],
                [
                    'commander' => 'Dargo, the Shipwrecker',
                    'decklist' => 'https://deckstats.net/decks/42204/1804823-commander-mix-red-dargo',
                    'color' => self::COLOR_R
                ],
                [
                   'commander' => 'Kediss, Emberclaw Familiar',
                    'decklist' => 'https://deckstats.net/decks/42204/1804791-commander-mix-red-kediss',
                    'color' => self::COLOR_R
                ],
                [
                    'commander' => 'Krark, the Thumbless',
                    'decklist' => 'https://deckstats.net/decks/42204/1803820-commander-mix-red-krark',
                    'color' => self::COLOR_R
                ],
                [
                    'commander' => 'Rograkh, Son of Rohgahh',
                    'decklist' => 'https://deckstats.net/decks/42204/1803819-commander-mix-red-rograkh',
                    'color' => self::COLOR_R
                ],
                [
                    'commander' => 'Toggo, Goblin Weaponsmith',
                    'decklist' => 'https://deckstats.net/decks/42204/1804824-commander-mix-red-toggo',
                    'color' => self::COLOR_R
                ],
                [
                   'commander' => 'Jeska, Thrice Reborn',
                    'decklist' => 'https://deckstats.net/decks/42204/1804843-commander-mix-red-jeska',
                    'color' => self::COLOR_R
                ],
                [
                    'commander' => 'Akroma, Vision of Ixidor',
                    'decklist' => 'https://deckstats.net/decks/42204/1804273-commander-mix-white-akroma',
                    'color' => self::COLOR_W
                ],
                [
                    'commander' => 'Alharu, Solemn Ritualist',
                    'decklist' => 'https://deckstats.net/decks/42204/1807644-commander-mix-white-alharu',
                    'color' => self::COLOR_W
                ],
                [
                    'commander' => 'Ardenn, Intrepid Archaeologist',
                    'decklist' => 'https://deckstats.net/decks/42204/1804395-commander-mix-white-ardenn',
                    'color' => self::COLOR_W
                ],
                [
                   'commander' => 'Keleth, Sunmane Familiar',
                    'decklist' => 'https://deckstats.net/decks/42204/1804695-commander-mix-white-keleth',
                    'color' => self::COLOR_W
                ],
                [
                    'commander' => 'Livio, Oathsworn Sentinel',
                    'decklist' => 'https://deckstats.net/decks/42204/1804332-commander-mix-white-livio',
                    'color' => self::COLOR_W
                ],
                [
                    'commander' => 'Prava of the Steel Legion',
                    'decklist' => 'https://deckstats.net/decks/42204/1804334-commander-mix-white-prava',
                    'color' => self::COLOR_W
                ],
                [
                    'commander' => 'Radiant, Serra Archangel',
                    'decklist' => 'https://deckstats.net/decks/42204/1803858-commander-mix-white-radiant',
                    'color' => self::COLOR_W
                ],
                [
                   'commander' => 'Rebbec, Architect of Ascension',
                    'decklist' => 'https://deckstats.net/decks/42204/1804357-commander-mix-white-rebbec',
                    'color' => self::COLOR_W
                ]
            ];

            foreach ($commanderMixtab as $commander) {
                 CommanderMix::factory()->create($commander);
            }
        }
}
