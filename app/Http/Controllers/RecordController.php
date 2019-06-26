<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\RandomTextGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    protected $record, $randomText;

    protected $redirectTo = '/record';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Record $records, RandomTextGenerator $randomTexts)
    {
        $this->record = $records;
        $this->randomText = $randomTexts;
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record = $this->record->all();
        return view('admin/records/record', ['records' => $record]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/records/forms/record-create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        switch ($request->giver_type) {
            case 'identified':

                $this->record->member_id = $request->gic;
                $this->record->service_type = $request->service_type;
                $this->record->record_type = $request->record_type;
                $this->record->given_at = $request->given_at;
                $this->record->status = $request->status;
                $this->record->tithe_amount = $request->tithe_amount;
                $this->record->love_amount = $request->love_amount;
                $this->record->faith_amount = $request->faith_amount;
                $this->record->total_amount = $request->total_amount;
                $this->record->created_by = $user->id;

                $isSaved = $this->record->save();

                $savedSpecOff = redirect()->route('specialOffering.getSpecialOffering', [
                    'special_offering' => $request->special_offering, 
                    'record_id' => $this->record->id]
                );

                $result = ($isSaved && $savedSpecOff) ? 'success' : 'failed';

                if($isSaved && $savedSpecOff) {
                    return response()->json([ 'result' => $result]);
                }

                break;

            case 'group':

                $this->record->group_name = $request->group_name;
                $this->record->service_type = $request->service_type;
                $this->record->record_type = $request->record_type;
                $this->record->given_at = $request->given_at;
                $this->record->status = $request->status;
                $this->record->tithe_amount = $request->tithe_amount;
                $this->record->love_amount = $request->love_amount;
                $this->record->faith_amount = $request->faith_amount;
                $this->record->total_amount = $request->total_amount;
                $this->record->created_by = $user->id;

                $isSaved = $this->record->save();

                return response()->json([ 'result' => $isSaved]);
                break;
            
            default:

                $agc = $this->randomText->generateAnonymousGiverCode();

                $this->record->agc = $agc;
                $this->record->service_type = $request->service_type;
                $this->record->record_type = $request->record_type;
                $this->record->given_at = $request->given_at;
                $this->record->status = $request->status;
                $this->record->tithe_amount = $request->tithe_amount;
                $this->record->love_amount = $request->love_amount;
                $this->record->faith_amount = $request->faith_amount;
                $this->record->total_amount = $request->total_amount;
                $this->record->created_by = $user->id;

                $isSaved = $this->record->save();

                return response()->json([ 'result' => $isSaved]);
                break;
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
