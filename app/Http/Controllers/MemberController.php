<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\CredentialsGenerator;
use App\Http\Resources\MemberResource;
use App\Http\Requests\StoreNewMember;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    protected $member;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/members';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Member $members)
    {
        $this->member = $members;
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the module main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $member = $this->member->all();
        return view('admin/members/member', ['members' => $member]);
    }

    /**
     * Show the form for creating a new member.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('admin/members/forms/member-create-form');
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewMember $request) {

        $memberCode = new RandomTextGenerator();

        $validated = $request->validated();

        $this->member->code = $memberCode->generateMemberCode();
        $this->member->first_name = $request->first_name;
        $this->member->middle_name = $request->middle_name;
        $this->member->last_name = $request->last_name;
        $this->member->birthday = $request->birthday;
        $this->member->age = $this->member->computeAge($request->birthday);
        $this->member->email = $request->email;
        $this->member->contact_number = $request->contact_number;
        $this->member->marital_status = $request->marital_status;
        $this->member->membership_status = $request->membership_status;
        $this->member->address_line_1 = $request->address_line_1;
        $this->member->barangay = $request->barangay;
        $this->member->city = $request->city;
        $this->member->province = $request->province;

        $this->member->save();

        return redirect('members')->with('status', 'New member added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = $this->member->findorFail($id);
        return view('admin/members/member-profile', ['memberData' => $member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $memberProfile = $this->member->find($id);

        $update = $memberProfile->update($request->all());

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

    /**
     * Get users for the data table.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCodeAndNameOfAllMembers()
    {
        $member = $this->member->all();
        return MemberResource::collection($member);
    }

}
