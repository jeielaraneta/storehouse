<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SetNewUserPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class SetUserPassword extends Controller
{

    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->user = $users;
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $user = $this->user->findOrFail($request->user);

        if($user->password_reset_at != null) {
            abort(401);
        }

        return view('auth/passwords/set-password', ['user_id' => $request->user, 'user' => $user]);
        //dd($request->user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //$validated = $request->validated();
        
        $newUser = $this->user->findOrFail($request->id);
        
        $newUser->password = Hash::make($request->password);
        $newUser->password_reset_at = Carbon::now();

        if($newUser && ($newUser->username === $request->username)) {
            
            $newUser->save();
            return redirect('login')->with('status', 'Password succesfully updated!');
        }

        else{
            return redirect()->back()->with('fail','Credentials are mismatched.');
        }

    }
    
}
