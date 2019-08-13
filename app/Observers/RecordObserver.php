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

    	$rec = $record->find($record->id);
        $rec->updated_by = Auth::id();
        //$rec->status = 'Modified';
        $rec->save();
    }

}
