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

    public function getDesignationAttribute($value) {

        $designation = '';

        switch ($value) {
            case 'ce':
                $designation = 'C.E.';
                break;
            case 'music':
                $designation = ucfirst($value);
                break;
            case 'outreach':
                $designation = ucfirst($value);
                break;
            case 'local_missions':
                $designation = ucfirst(str_replace('_', ' ', $value));
                break;
            case 'intl_missions':
                $designation = 'International Missions';
                break;
            case 'intl_missions':
                $designation = 'International Missions';
                break;
            case 'others':
                $designation = ucfirst($value);
                break;
            
            default:
                # code...
                break;
        }
        
        return $designation;

    }

}
