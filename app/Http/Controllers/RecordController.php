<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\RandomTextGenerator;
use Illuminate\Http\Request;

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
        switch ($request->giver_type) {
            case 'identified':
                return response()->json([ 'gic' => $request->gic]);
                break;

            case 'group':
                return response()->json([ 'agc' => $request->agc]);
                break;
            
            default:
                return response()->json([ 'random text' => $this->randomText->generateAnonymousGiverCode() ]);
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
