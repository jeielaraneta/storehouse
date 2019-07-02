<?php

use Illuminate\Database\Seeder;
use App\Traits\RandomTextGenerator;
use Carbon\Carbon;

class MembersTableSeeder extends Seeder
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
    			'code' => $this->generateMemberCode(),
	            'first_name' => 'Leonele', 
	            'middle_name' => 'Villarosa', 
	            'last_name'=> 'Castro', 
	            'birthday' => '1993-09-09',
	            'age' => 25,
	            'email' => 'leonele@gmail.com', 
	            'contact_number' => '09081762534', 
	            'marital_status' => 'single', 
	            'membership_status' => 'active', 
	            'address_line_1' => '#14 Road 2', 
	            'barangay' => 'Tandang Sora', 
	            'city' => 'Quezon City', 
	            'province' => 'Metro Manila',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ],

	        [
    			'code' => $this->generateMemberCode(),
	            'first_name' => 'Sam', 
	            'middle_name' => 'Samar', 
	            'last_name'=> 'Malano', 
	            'birthday' => '1994-08-09',
	            'age' => 24, 
	            'email' => 'samalano@gmail.com', 
	            'contact_number' => '090817567532', 
	            'marital_status' => 'single', 
	            'membership_status' => 'active', 
	            'address_line_1' => 'Gudanovile', 
	            'barangay' => 'Fairview', 
	            'city' => 'Quezon City', 
	            'province' => 'Metro Manila',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
	        ]
    	);
    	
        DB::table('members')->insert($data);
    }
}
