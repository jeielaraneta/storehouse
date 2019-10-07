<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Traits\RandomTextGenerator;

class UsersTableSeeder extends Seeder
{
    use RandomTextGenerator;
	

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
            [
                'username' => $this->generateUsername('John Jeiel', 'Noblejas', 'Araneta'),
                'first_name' => 'John Jeiel',
                'middle_name' => 'Noblejas',
                'last_name' => 'Araneta',
                'contact_number' => '09081858655',
                'email' => 'jeielaraneta@gmail.com',
                'password' => bcrypt('secret123'),
            ],
            [
                'username' => $this->generateUsername('Service', 'Check', 'Account'),
                'first_name' => 'Service',
                'middle_name' => 'Check',
                'last_name' => 'Account',
                'contact_number' => '09081858655',
                'email' => 'service_account@gmail.com',
                'password' => bcrypt('service123'),
            ]
        );

        DB::table('users')->insert($data);

    }
}
