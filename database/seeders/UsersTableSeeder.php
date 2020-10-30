<?php
namespace Database\Seeders;

use App\Role\UserRole;
use App\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    const USERS = [
        [
            'name' => 'Thomas SIMON',
            'email' => 'thomas.simon4205@gmail.com',
            'roles' => '["'.UserRole::ROLE_SUPERADMIN.'"]'
        ],
        [
            'name' => 'Herunim',
            'email' => 'herunim@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_COMMANDANT.'"]'
        ],
        [
            'name' => 'Gard Ien',
            'email' => 'gardien@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_GARDIEN.'"]'
        ],
        [
            'name' => 'Super Gard Ien',
            'email' => 'supergardien@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_GARDIEN.'","'. UserRole::ROLE_DECK_EVALUATOR.'"]'
        ],
        [
            'name' => 'Disc Ord',
            'email' => 'discord@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_DISCORD.'"]'
        ],
        [
            'name' => 'Redac Chef',
            'email' => 'redacchef@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_REDAC_CHEF.'"]'
        ],
        [
            'name' => 'Deck Eval',
            'email' => 'deckEval@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_DECK_EVALUATOR.'"]'
        ],
        [
            'name' => 'Redac',
            'email' => 'redac@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_REDAC.'"]'
        ],
        [
            'name' => 'James Magick',
            'email' => 'membre@tourdecom.fr',
            'roles' => '["'.UserRole::ROLE_MEMBRE.'"]'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(2000)->create();
        foreach(self::USERS as $u) {
            DB::table('users')->insert([
                'name' => $u['name'],
                'email' => $u['email'],
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'roles' => $u['roles']
            ]);
        }
    }
}
