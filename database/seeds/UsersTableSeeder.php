<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CredentialsGenerator;

class UsersTableSeeder extends Seeder
{

	protected $credGen;

	public function __construct(CredentialsGenerator $credGen) {
        $this->credGen = $credGen;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => $this->credGen->generateUsername('John Jeiel', 'Noblejas', 'Araneta'),
            'first_name' => 'John Jeiel',
            'middle_name' => 'Noblejas',
            'last_name' => 'Araneta',
            'contact_number' => '09081858655',
            'email' => 'jeielaraneta@gmail.com',
            'password' => bcrypt('secret123'),
        ]);

    }
}
