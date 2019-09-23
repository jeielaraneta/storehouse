<?php

namespace App\Observers;

use App\Models\Record;
use Illuminate\Support\Facades\Auth;

class RecordObserver
{
    /**
     * Handle the record "updated" event.
     *
     * @param  \App\Models\Record  $record
     * @return void
     */
    public function updated(Record $record) {

        $user = Auth::user();

    	$rec = $record->find($record->id);
        $rec->updated_by = $user->username;
        //$rec->status = 'Modified';
        $rec->save();
    }

    public function creating(Record $record) {
        
    }

}
