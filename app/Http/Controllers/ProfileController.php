<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::where('id',Auth::id())->first();

        return view('backend.settings.profile', compact('user'));
    }


    public function profileUpdate(Request $request)
    {
        request()->validate([
          'name'      => 'required|string|max:250',
          'email'     => 'required|string|email|max:250',
          'photo'     => 'image|mimes:jpg,png,jpeg'
        ]);

        if(isset($request->status)){
            $status = true;
        }else{
            $status = false;
        }

        $user = User::findOrFail(Auth::id());

        if ($request->hasFile('photo')) {

            if(file_exists(public_path('images/') . $user->photo) && ($user->photo != 'default.png')){
                unlink(public_path('images/') . $user->photo);
            }
            $imageName = 'photo-'.time().uniqid().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('images'), $imageName);
        }else{
            $imageName = $user->photo;
        }

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'photo'     => $imageName,
            'status'    => $status
        ]);

        $notification = [
            'message' => 'Profile updated successfully!'
        ];

        if (request('status')) {
            return back()->with($notification);
        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    }


    public function changePassword(Request $request)
    {     
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
            return back()->with([
                'message'    => 'Your current password does not matches with the password you provided! Please try again.',
                'alert-type' => 'error'
            ]);
        }

        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){
            return back()->with([
                'message'    => 'New Password cannot be same as your current password! Please choose a different password.',
                'alert-type' => 'error'
            ]);
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword'     => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        return back()->with(['message' => 'Password changed successfully.']);
    }
}
