<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view("admin.login");
        }
        
    }
    

    /**
     * Authentication the admin login.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $email =  $request->post('email');
        $password =  $request->post('password');
        // $result = Admin::where(['email'=>$email, 'password'=>$password])->get();
        $result = Admin::where([ 'email' => $email ])->first();
        
        if($result){
            if(Hash::check($password, $result->password)){
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $result->id);
                $request->session()->put('ADMIN_EMAIL', $result->email);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error', 'Please enter valid login details');
                return redirect('admin');
            }
        }else{
            $request->session()->flash('error', 'Please enter valid login details');
            return redirect('admin');
        }
    }

    public function updatePass()
    {
        $r = Admin::find(1);
        $r->password = Hash::make('arjishat');
        $r->save();
    }

    public function logout()
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->forget('ADMIN_EMAIL');
        return redirect('admin');
    }

    public function dashboard()
    {
        return view("admin.dashboard");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
