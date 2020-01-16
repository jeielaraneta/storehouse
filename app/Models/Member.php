<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{

	use Notifiable, SoftDeletes; //HasApiTokens
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'first_name', 'middle_name', 'last_name', 'birthday', 'age', 'email', 'contact_number', 'marital_status', 'membership_status', 'member_account_status', 'address_line_1', 'barangay', 'city', 'province', 'created_at'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the record for the member.
    */
    public function record()
    {
        return $this->hasMany('App\Models\Record');
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = ucfirst($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = date('Y-m-d', strtotime($value));
    }

    public function setAgeAttribute($value) {
        $this->attributes['age'] = $this->computeAge($this->attributes['birthday']);
    }

    public function getCreatedAtAttribute($value) {
        return date('m-d-Y h:i A', strtotime($value));
    }

    public function getMembershipStatusAttribute($value){
        return ucfirst($value); //$value ? 'Active' : 'Inactive';
    }

    public function computeAge($birthday){

    	$memberBday = date('Y-m', strtotime($birthday)); // Your date of birth
		$age = date_diff(date_create($memberBday), date_create('now'))->y;

    	return $age;
    }
    
}
