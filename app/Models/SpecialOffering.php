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

    /**
     * Get the record that owns the special offering.
     */
    public function record()
    {
        return $this->belongsTo('App\Models\Record');
    }

}
