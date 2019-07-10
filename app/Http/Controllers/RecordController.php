<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\SpecialOffering;
use App\Traits\RandomTextGenerator;
use App\Http\Resources\RecordResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

        switch ($request->giver_type) {
            case 'identified':

                $data = array(
                    'member_id' => $request->gic,
                    'service_type' => $request->service_type,
                    'record_type' => $request->record_type,
                    'giver_type' => $request->giver_type,
                    'given_at' => date('Y-m-d', strtotime($request->given_at)),
                    'status' => $request->status,
                    'tithe_amount' => $request->tithe,
                    'love_amount' => $request->love,
                    'faith_amount' => $request->faith,
                    'total_amount' => $request->total_amount,
                    'created_by' => $user->id
                );

                $saveAndGetID = DB::table('records')->insertGetId($data);

                $specOff = $request->special_offering;

                foreach ($specOff as $key => $value) {
                    $specOff[$key]['record_id'] = $saveAndGetID;
                    $specOff[$key]['created_at'] = Carbon::now();
                    $specOff[$key]['updated_at'] = Carbon::now();
                }

                $saveSpecOff = SpecialOffering::insert($specOff);

                $result = ($saveAndGetID && $saveSpecOff) ? true : false;

                return response()->json([ 'success' => $result]);

                break;

            case 'group':

                $data = array(
                    'group_name' => $request->group_name,
                    'service_type' => $request->service_type,
                    'record_type' => $request->record_type,
                    'giver_type' => $request->giver_type,
                    'given_at' => date('Y-m-d', strtotime($request->given_at)),
                    'status' => $request->status,
                    'tithe_amount' => $request->tithe,
                    'love_amount' => $request->love,
                    'faith_amount' => $request->faith,
                    'total_amount' => $request->total_amount,
                    'created_by' => $user->id
                );

                $saveAndGetID = DB::table('records')->insertGetId($data);

                $specOff = $request->special_offering;

                foreach ($specOff as $key => $value) {
                    $specOff[$key]['record_id'] = $saveAndGetID;
                    $specOff[$key]['created_at'] = Carbon::now();
                    $specOff[$key]['updated_at'] = Carbon::now();
                }

                $saveSpecOff = SpecialOffering::insert($specOff);

                $result = ($saveAndGetID && $saveSpecOff) ? true : false;

                return response()->json([ 'success' => $result]);

                break;
            
            default:

                $agc = $this->generateAnonymousGiverCode();

                $data = array(
                    'agc' => $agc,
                    'service_type' => $request->service_type,
                    'record_type' => $request->record_type,
                    'giver_type' => $request->giver_type,
                    'given_at' => date('Y-m-d', strtotime($request->given_at)),
                    'status' => $request->status,
                    'tithe_amount' => $request->tithe,
                    'love_amount' => $request->love,
                    'faith_amount' => $request->faith,
                    'total_amount' => $request->total_amount,
                    'created_by' => $user->id
                );

                $saveAndGetID = DB::table('records')->insertGetId($data);

                $specOff = $request->special_offering;

                foreach ($specOff as $key => $value) {
                    $specOff[$key]['record_id'] = $saveAndGetID;
                    $specOff[$key]['created_at'] = Carbon::now();
                    $specOff[$key]['updated_at'] = Carbon::now();
                }

                $saveSpecOff = SpecialOffering::insert($specOff);

                $result = ($saveAndGetID && $saveSpecOff) ? true : false;

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
        $record = $this->record->findorFail($id);

        //$specialOfferings = SpecialOffering::where('record_id', $id);

        $specialOfferings = $this->record->specialOfferings()->find($id);//SpecialOffering::find($id)->record;

        return view('admin/records/record-profile', ['recordData' => $record, 'specialOfferingsData' => $specialOfferings ]);
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
