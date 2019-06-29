<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\SpecialOffering;
use App\Traits\RandomTextGenerator;
use App\Http\Resources\RecordResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RecordController extends Controller
{
    use RandomTextGenerator;

    protected $record, $specialOffering, $members;

    protected $redirectTo = '/records';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Record $records, SpecialOffering $so)
    {
        $this->record = $records;
        $this->specialOffering = $so;
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
                $this->record->giver_type = $request->giver_type;
                $this->record->given_at = $request->given_at;
                $this->record->status = $request->status;
                $this->record->tithe_amount = $request->tithe;
                $this->record->love_amount = $request->love;
                $this->record->faith_amount = $request->faith;
                $this->record->total_amount = $request->total_amount;
                $this->record->created_by = $user->id;

                $isSaved = $this->record->save();

                $specOff = $request->special_offering;

                foreach ($specOff as $key => $value) {
                    $specOff[$key]['record_id'] = $this->record->id;
                    $specOff[$key]['created_at'] = Carbon::now();
                    $specOff[$key]['updated_at'] = Carbon::now();
                }

                $saveSpecOff = SpecialOffering::insert($specOff);

                $result = ($isSaved && $saveSpecOff) ? true : false;

                return response()->json([ 'success' => $result]);

                break;

            case 'group':

                $this->record->group_name = $request->group_name;
                $this->record->service_type = $request->service_type;
                $this->record->record_type = $request->record_type;
                $this->record->giver_type = $request->giver_type;
                $this->record->given_at = $request->given_at;
                $this->record->status = $request->status;
                $this->record->tithe_amount = $request->tithe_amount;
                $this->record->love_amount = $request->love_amount;
                $this->record->faith_amount = $request->faith_amount;
                $this->record->total_amount = $request->total_amount;
                $this->record->created_by = $user->id;

                $isSaved = $this->record->save();

                $specOff = $request->special_offering;

                foreach ($specOff as $key => $value) {
                    $specOff[$key]['record_id'] = $this->record->id;
                    $specOff[$key]['created_at'] = Carbon::now();
                    $specOff[$key]['updated_at'] = Carbon::now();
                }

                $saveSpecOff = SpecialOffering::insert($specOff);

                $result = ($isSaved && $saveSpecOff) ? true : false;

                return response()->json([ 'success' => $result]);

                break;
            
            default:

                $agc = $this->generateAnonymousGiverCode();

                $this->record->agc = $agc;
                $this->record->service_type = $request->service_type;
                $this->record->record_type = $request->record_type;
                $this->record->giver_type = $request->giver_type;
                $this->record->given_at = $request->given_at;
                $this->record->status = $request->status;
                $this->record->tithe_amount = $request->tithe_amount;
                $this->record->love_amount = $request->love_amount;
                $this->record->faith_amount = $request->faith_amount;
                $this->record->total_amount = $request->total_amount;
                $this->record->created_by = $user->id;

                $isSaved = $this->record->save();

                $specOff = $request->special_offering;

                foreach ($specOff as $key => $value) {
                    $specOff[$key]['record_id'] = $this->record->id;
                    $specOff[$key]['created_at'] = Carbon::now();
                    $specOff[$key]['updated_at'] = Carbon::now();
                }

                $saveSpecOff = SpecialOffering::insert($specOff);

                $result = ($isSaved && $saveSpecOff) ? true : false;

                return response()->json([ 'success' => $result]);

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
        //lagyan mo ng where
        $records = $this->record->findorFail($id);

        return new RecordResource($records);

        //return view('admin/records/record', ['records' => $records]);
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

    public function apiResource(){
        $record = $this->record->all();
        return RecordResource::collection($record);
    }
}
