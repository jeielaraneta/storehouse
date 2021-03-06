<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\SpecialOffering;
use App\Traits\RandomTextGenerator;
use App\Http\Resources\RecordResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class RecordController extends Controller
{
    use RandomTextGenerator;

    protected $record;

    protected $redirectTo = '/records';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Record $records)
    {
        $this->record = $records;
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

        $identifier = array();

        switch ($request->giver_type) {
            case 'identified':

                $identifier = array('member_id' => $request->gic);

                break;

            case 'group':

                $identifier = array('group_name' => $request->group_name);

                break;
            
            default:

                $agc = $this->generateAnonymousGiverCode();

                $identifier = array('agc' => $agc);

                break;
        }

        $data = array(
            'service_type' => $request->service_type,
            'record_type' => $request->record_type,
            'offer_method' => $request->offer_method,
            'check_reference' => $request->check_reference,
            'bank_name' => $request->bank_name,
            'currency' => $request->currency,
            'convert_to_peso' => $request->convert_to_peso,
            'giver_type' => $request->giver_type,
            'given_at' => date('Y-m-d', strtotime($request->given_at)),
            'status' => $request->status,
            'tithe_amount' => $request->tithe,
            'love_amount' => $request->love,
            'faith_amount' => $request->faith,
            'total_amount' => $request->total_amount,
            'created_by' => $user->username
        );

        $recordData = array_merge($data, $identifier);

        $createRecord = $this->record->create($recordData);

        $specOff = $request->special_offering;

        $getRecord = $this->record->find($createRecord->id);

        $saveSpecOff = $getRecord->specialOfferings()->createMany($specOff);

        $result = ($createRecord && $saveSpecOff) ? true : false;

        return response()->json([ 'success' => $result]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $record = $this->record->findorFail($id);

        $specialOfferings = $this->record->with('specialOfferings')->find($id)->specialOfferings;

        return view('admin/records/record-profile', ['records' => $record, 'specialOfferings' => $specialOfferings ]);
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

        $record = $this->record->find($id);

        $update = $record->update($request->all());

        return response()->json([ 'success' => $update ? true : false]);
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
