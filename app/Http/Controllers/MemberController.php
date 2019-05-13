<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    protected $member;

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
        return view('admin/members/member');
    }

    /**
     * Show the form for creating a new member.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('admin/members/member-create-form');
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->member->age = $this->member->computeAge($request->birthday);
        dd($this->member->age);*/

        $validated = $this->validator($request->all());

        if(!$validated) {
            return redirect('member-create')->withErrors($validator, 'Member');
        }
      
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

        return redirect( route('create-member'));
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

    /**
     * Get a validator for an incoming member registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['digits:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }
}
