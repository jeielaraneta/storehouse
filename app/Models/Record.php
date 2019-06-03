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
        'gic', 'service_type', 'record_type', 'given_at', 'status', 'tithe_amount', 'love_amount', 'faith_amount', 'special_offering', 'designation', 'total_amount', 'member_id'
    ];
}
