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
                $designation = strtoupper($value);
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

            case 'foreign_missions':
                $designation = ucfirst(str_replace('_', ' ', $value));
                break;

            case 'dorcas':
                $designation = ucfirst($value);
                break;

            case 'switch':
                $designation = strtoupper($value);
                break;

            case 'gauis':
                $designation = ucfirst($value);
                break;

            case 'vop':
                $designation = strtoupper($value);
                break;

            case 'rsg':
                $designation = strtoupper($value);
                break;

            case 'youth_ministry':
                $designation = ucfirst(str_replace('_', ' ', $value));
                break;

            case 'des_love_gift':
                $designation = 'Desginated Love Gift';
                break;

            case 'financial_assistance':
                $designation = ucfirst(str_replace('_', ' ', $value));
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

    /*public function getDesignatedAmountAttribute($value) {
        return number_format($value, 2);
    }*/

}
