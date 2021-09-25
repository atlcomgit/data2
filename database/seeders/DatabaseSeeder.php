<?php // php artisan migrate --seed

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'name' => 'alek',
            'email' => 'alek@atlcom.ru',
            'password' => bcrypt('12343456'),
            'active' => true,
        ]); // создать случайного пользователя
    }
}