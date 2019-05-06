<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

	use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'first_name', 'middle_name', 'last_name', 'birthday', 'age', 'email', 'contact_number', 'marital_status', 'membership_status', 'address_line_1', 'barangay', 'city', 'province'
    ];

    
}
