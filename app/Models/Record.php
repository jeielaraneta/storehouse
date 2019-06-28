<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    
    use Notifiable; //HasApiTokens
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_name', 'agc', 'service_type', 'record_type', 'given_at', 'status', 'tithe_amount', 'love_amount', 'faith_amount', 'special_offering', 'designation', 'total_amount', 'member_id', 'created_by'
    ];

    /**
     * Get the member that owns the record.
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    /**
     * Get the special offerings for the record.
    */
    public function specialOfferings()
    {
        return $this->hasMany('App\Models\SpecialOffering');
    }

    public function setGivenAtAttribute($value)
    {
        $this->attributes['given_at'] = date('Y-m-d', strtotime($value));
    }
}
