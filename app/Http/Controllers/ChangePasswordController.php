<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('change-password', [
            'title' => 'Change Password'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        DB::beginTransaction();
        try{

            if(\Hash::check($request->current_password, auth()->user()->password)){
                auth()->user()->password = bcrypt($request->password);
                auth()->user()->save();

                DB::commit();
                session()->flash('success', "Password updated successfully.");
                return redirect()->back();
            }

            session()->flash('danger', "Password does not matched!");
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            session()->flash('success', $th->getMessage());
            return redirect()->back();
        }
    }
}
