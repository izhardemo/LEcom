<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;
use App\Actions\Fortify\PasswordValidationRules;

class UserProfileController extends Controller
{
    use PasswordValidationRules;
    
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        $permissions = User::pluck('id')->toArray();

        if ($user->hasRole('user')) {
            $request->validate([
                'current_password' => 'required|string',
                'password' => $this->passwordRules(),
            ]);

            if (! Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => [__('The provided password does not match your current password.')],
                ]);
                return back();
            }
            $user->password = Hash::make($request->password);
            
            if ($user->save()) {

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->route('login')->with('status', 'Profile password has been successfully changed. Please login again!');
            } else {
                return redirect()->route('user.profile.view')->with('error', 'Something went wrong. Please try again!');
            }

        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone_number' => 'required|digits:10|unique:users,phone_number,'.$user->id,
            'file' => 'image',
        ]);
        if ($request->hasFile('file')) {
            $photo = $request->file('file');
            $photoName = 'photo_'.time().'.'.$photo->clientExtension();
            if(Storage::exists('public/media/images/user/profile-photo/'.$user->photo)){
                Storage::delete(['public/media/images/user/profile-photo/'.$user->photo]);
            }
            $photo->storeAs('media/images/user/profile-photo',$photoName,'public');
            $filename = 'media/images/user/profile-photo/'.$photoName;
        } else {
            $filename = $user->profile_photo_path;
        }
        $user->profile_photo_path = $filename;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        if ($user->save()) {
            return redirect()->route('user.profile.view')->with('success', 'Profile has been successfully saved');
        } else {
            return redirect()->route('user.profile.view')->with('error', 'Something went wrong. Please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $type, StatefulGuard $guard, Request $request)
    {
        if ($type == 'photo') {
            if(Storage::exists('public/'.$user->profile_photo_path)){
                Storage::delete(['public/'.$user->profile_photo_path]);
            }
            $user->profile_photo_path = null;
            if ($user->save()) {
                return redirect()->route('user.profile.view')->with('success', 'Profile photo has been successfully removed.');
            } else {
                return redirect()->route('user.profile.view')->with('error', 'Something went wrong. Please try again!');
            }
        }
        if ($type == 'session') {

            if (! Hash::check($request->cpassword, Auth::user()->password)) {
                return back()->with('error',__('This password does not match our records.'));
            }

            $guard->logoutOtherDevices($request->cpassword);

            $this->deleteOtherSessionRecords();

            return back()->with('success','You have successfully loged out from other divices.');
        }
        
    }
    protected function deleteOtherSessionRecords()
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', '!=', request()->session()->getId())
            ->delete();
    }
}