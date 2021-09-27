<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Mail;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if($request->session()->has('USER_LOGIN')){
        //     return redirect('/');
        // }else{
        //     return view("front.login");
        // }
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

        $validate = Validator::make($request->all(), [
            'name'=> 'required|regex:/^[a-zA-Z ]*$/',
            'email'=> 'required|email:filter|unique:customers,customer_email',
            'password'=>'required',
        ]);

        

        if(!$validate->passes()){
            return response()->json(['status'=>'error', 'error' => $validate->errors()]);
        }else{
            $rand = Str::random(40);

            $model = new Customer;
            $model->customer_name = $request->post('name');
            $model->customer_email = $request->post('email');
            $model->customer_password = Hash::make($request->post('password'));
            $model->is_verify = 0;
            $model->rand_id = $rand;
            $model->save();
            
            $data = ['name'=>$request->post('name'), 'rand_id'=> $rand];
            $user['to'] = $request->post('email');
            Mail::send('utility/email_verify_tmp', $data, function($message) use($user){
                $message->to($user['to']);
                $message->subject('Verify your email');
            });


            return response()->json(['status'=>'success', 'msg' => "Register successfully. Please check your email for verify"]);
        }

        
    }

    public function getLogin(Request $request){
        $validate = Validator::make($request->all(), [
            'email'=> 'required|email:filter',
            'password'=>'required',
        ]);

        if(!$validate->passes()){
            return response()->json(['status'=>'error', 'error' => $validate->errors()]);
        }else{
            $email =  $request->post('email');
            $password =  $request->post('password');
            $result = Customer::where([ 'customer_email' => $email ])->first();
            
            if($result){
                
                    if(Hash::check($password, $result->customer_password)){
                        if($result->is_verify === 1){
                            if($request->post('rememberMe') == "on"){
                                setcookie('remember_email',  $result->customer_email,time()+60*60*24*365);
                                setcookie('remember_password',  $password,time()+60*60*24*365);
                            }else{
                                setcookie('remember_email',  $result->customer_email, 100);
                                setcookie('remember_password',  $password, 100);
                            }
                            $request->session()->put('CUSTOMER_LOGIN', true);
                            $request->session()->put('CUSTOMER_ID', $result->id);
                            $request->session()->put('CUSTOMER_NAME', $result->customer_name);
                            $request->session()->put('CUSTOMER_EMAIL', $result->customer_email);
                            return response()->json(['status'=>'success', 'msg' => "Login successfully"]);
                        }else{
                            return response()->json(['status'=>'msg', 'msg' => "You email is not verified. Please verify your email"]);
                        }
                        
                    }else{
                        return response()->json(['status'=>'msg', 'msg' => "Please enter valid login details"]);
                    }



                
                
            }else{
                return response()->json(['status'=>'msg', 'msg' => "Please enter valid login details"]);
            }
        }

        
    }

    public function userLogout()
    {
        session()->forget('CUSTOMER_LOGIN');
        session()->forget('CUSTOMER_ID');
        session()->forget('CUSTOMER_NAME');
        session()->forget('CUSTOMER_EMAIL');
        return redirect('/');
    }
    

    public function email_verification(Request $request, $id){
        $result = Customer::where([ 'rand_id' => $id ])->first();
        if(isset($result)){
            $model = Customer::find($result['id']);

            if($model){
                $model->is_verify = 1;
                $model->rand_id = "";
                $model->save();

                session()->flash('message', "Email verify successfully. You can login now");
                return redirect('login');
            }else{
                session()->flash('error', "Something went wrong. please try again");
                return redirect('login');
            }
        }else{
            return view('404');
        }
    }


    public function submit_forgot_password(Request $request){
        $validate = Validator::make($request->all(), [
            'email'=> 'required|email:filter',
        ]);

        if(!$validate->passes()){
            return response()->json(['status'=>'error', 'error' => $validate->errors()]);
        }else{
            $result = Customer::where([ 'customer_email' => $request->post('email') ])->first();
            if(isset($result)){
                if($result['is_verify'] == 1){
                    $rand = Str::random(40);

                    $model = Customer::find($result['id']);
                    $model->rand_id = $rand ;
                    $model->save();
    
                    $data = ['name'=>$result['customer_name'], 'rand_id'=> $rand];
                    $user['to'] = $request->post('email');
                    Mail::send('utility/recover_password_temp', $data, function($message) use($user){
                        $message->to($user['to']);
                        $message->subject('Recover your password');
                    });

                    return response()->json(['status'=>'success', 'msg' => "Please check your email for recover your password"]);
                }else{
                    return response()->json(['status'=>'fail', 'msg' => "Email is not verify. Please verify your email"]);
                }
                



            }else{
                return response()->json(['status'=>'fail', 'msg' => "Email does not exists"]);
            }
        }

        
    }

    public function recover_password(Request $request, $id){

        $result = Customer::where([ 'rand_id' => $id ])->first();
        if(isset($result)){
            $data['id'] = $id;
            return view('front.recover-password', $data);
        }else{
            return view('404');
        }
    }

    public function recover_password_submit(Request $request){
        $validate = Validator::make($request->all(), [
            'password'=> 'required',
            'randId'=> 'required',
        ]);

        if(!$validate->passes()){
            return response()->json(['status'=>'fail', 'msg' => "All input must require"]);
        }else{
            $result = Customer::where([ 'rand_id' => $request->post('randId') ])->first();
            if(isset($result)){
                if($result['is_verify'] == 1){
 
                    $model = Customer::find($result['id']);
                    $model->customer_password = Hash::make($request->post('password'));
                    $model->rand_id = "";
                    $model->save();
                    session()->flash('message', "Password change successfully");
                    return response()->json(['status'=>'success', 'msg' => url('login')]);
                }else{
                    return response()->json(['status'=>'fail', 'msg' => "Email is not verify. Please verify your email"]);
                }
                



            }else{
                return response()->json(['status'=>'fail', 'msg' => "Invalid information"]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
