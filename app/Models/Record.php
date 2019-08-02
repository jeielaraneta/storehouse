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
        'group_name', 'agc', 'bank_ref', 'service_type', 'record_type', 'given_at', 'status', 'tithe_amount', 'love_amount', 'faith_amount', 'special_offering', 'designation', 'total_amount', 'member_id', 'created_by'
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

    public function getGiverTypeAttribute($value) {
        return ucwords(str_replace('_', ' ', $value));
    }

    public function getAgcAttribute($value) {
        $ident = '';

        switch ($this->giver_type) {
            case 'Identified':
                $ident = $this->member->first_name . ' ' . $this->member->last_name;
                break;

            case 'Group':
                $ident = $this->group_name;
                break;

            case 'Bank Depositor':
                $ident = $this->bank_ref;
                break;
            
            default:
                $ident = $value;
                break;
        }

        return ucfirst($ident);
    }

    public function getStatusAttribute($value) {

        switch ($value) {
            case 1:
                return 'Verified';
                break;

            case 2:
                return 'To be updated';
                break;

            case 3:
                return 'Modified';
                break;

            case 4:
                return 'To archive';
                break;

            case 5:
                return 'Archived';
                break;
            
            default:
                return 'Unverified';
                break;
        }

        //return $value == 0 ?  'Unverified' : 'Verified';
    }

    public function getRecordTypeAttribute($value) {
        return $value == 'dd' ?  'Direct Depositor' : 'Offering Box';
    }

    public function getTotalAmountAttribute($value) {
        return number_format($value, 2);
    }

    public function setGivenAtAttribute($value)
    {
        $this->attributes['given_at'] = date('Y-m-d', strtotime($value));
    }

    public function setStatusAttribute($value) {

        switch ($value) {
            case 'Verified':
                $this->attributes['status'] = 1;
                break;

            case 'To be updated':
                $this->attributes['status'] = 2;
                break;

            case 'Modified':
                $this->attributes['status'] = 3;
                break;

            case 'To archive':
                $this->attributes['status'] = 4;
                break;

            case 'Archived':
                $this->attributes['status'] = 5;
                break;
            
            default:
                $this->attributes['status'] = 0;
                break;
        }
    }

    /*public function getTitheAmountAttribute($value) {
        return number_format($value, 2);
    }

    public function getLoveAmountAttribute($value) {
        return number_format($value, 2);
    }

    public function getFaithAmountAttribute($value) {
        return number_format($value, 2);
    }*/
}
