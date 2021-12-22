<?php
namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'   => 'admin',
            'password' => bcrypt('christopher'),
            'firstname'  => 'Christopher',
            'middlename' => 'Platino',
            'lastname'   => 'Vistal',
        ]);
    }
}
