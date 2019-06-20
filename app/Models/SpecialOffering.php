<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SpecialOffering extends Model
{
    use Notifiable; //HasApiTokens

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation', 'designated_for', 'designated_amount', 'record_id'
    ];
}
