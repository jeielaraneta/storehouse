<?php

namespace App\Observers;

use App\Record;
use Illuminate\Support\Facades\Auth;

class RecordObserver
{
    /**
     * Handle the record "created" event.
     *
     * @param  \App\Record  $record
     * @return void
     */
    public function creating(Record $record)
    {
        dd($record);
       /* $record->created_by = Auth::id();
        $record->save();*/
    }

    /**
     * Handle the record "updated" event.
     *
     * @param  \App\Record  $record
     * @return void
     */
    public function updated(Record $record)
    {
        $record->updated_by = Auth::id();
        $record->save();
    }

    /**
     * Handle the record "deleted" event.
     *
     * @param  \App\Record  $record
     * @return void
     */
    public function deleted(Record $record)
    {
        //
    }

    /**
     * Handle the record "restored" event.
     *
     * @param  \App\Record  $record
     * @return void
     */
    public function restored(Record $record)
    {
        //
    }

    /**
     * Handle the record "force deleted" event.
     *
     * @param  \App\Record  $record
     * @return void
     */
    public function forceDeleted(Record $record)
    {
        //
    }
}
