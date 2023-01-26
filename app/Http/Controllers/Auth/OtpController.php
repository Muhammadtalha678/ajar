<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Twilio\Rest\Client; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Carbon\Carbon;
use Session;
use App\Providers\RouteServiceProvider;
class OtpController extends Controller
{
    // public function store(Request $request)
    // {
    // 	$request->validate([
    // 		'name' => ['required', 'string', 'max:255'],
    // 		'phone' => ['required', 'numeric', 'unique:users'],
    // 		'password' => ['required', 'confirmed', Rules\Password::defaults()]
    // 	]);
    // 	// echo $data['phone'];exit();
    // 	// echo $request->phone;exit();
         
    //      // $phone->$request->phone; ;exit();
    // 	$token = getenv("TWILIO_AUTH_TOKEN");
    //     $twilio_sid = getenv("TWILIO_SID");
    //     $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    //     $twilio = new Client($twilio_sid, $token);
    //     $twilio->verify->v2->services($twilio_verify_sid)->verifications->create($request->phone, "sms");
    // 	// $user = new User;
    //     $user = User::insert([
    //     	'name' => $request->name,
    //     	'phone' => $request->phone,
    //     	'password' => Hash::make($request->password),
    //     ]);
    //     // Auth::login($user);
    //     return redirect()->route('verify.show')->with('phone_no',$request->phone);
    // }
    public function verify()
    {
        // session::forget('user_detail');
        if (Session::has('user_detail')) {
            
    	return view('auth.verify');
        }
        else{
            return redirect()->route('register')->with('errorm','First Register Your Self');
        }
    }
    public function verifystore(Request $request)
    {
        $currentTime = Carbon::now("Asia/Karachi");
    	$data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required'],
        ]);
            $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        try {
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks->create(['code' => $data['verification_code'], 'to' => $data['phone_number']]);
            if ($verification->valid) {
                $user = Session::get('user_detail');
                
                

                User::insert([
                    'name'=>$user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),

                ]);
                Session::forget('user_detail');
                // $user = tap(User::where('email', $data['phone_number']))->update(['  email_verified_at' => time()]);
                $user = tap(User::where('email', $data['phone_number']))->update([
                    'email_verified_at' => $currentTime
                ]); 
                /* Authenticate user */

                Auth::login($user->first());
                return redirect(RouteServiceProvider::HOME)->with(['message' => 'Phone number verified']);
            }    
        }  catch (\Twilio\Exceptions\RestException $e) {
                $errorm = "Error sending SMS: ".$e->getCode() . ' : ' . $e->getMessage()."\n"; 
                return redirect()->route('verify.show')->with(['errorm'=>$errorm,'phone_no'=>$request->phone_number]);
                // echo "Error sending SMS: ".$e->getCode() . ' : ' . $e->getMessage()."\n";
            }
        
            // print($verification->status);exit;
        
         return back()->with(['phone_no' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
    }
    public function resend(Request $request)
    {
        if ($request->phone_number) {
                $token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_sid = getenv("TWILIO_SID");
                $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
                $twilio = new Client($twilio_sid, $token);
                 try {
                $twilio->verify->v2->services($twilio_verify_sid)->verifications->create($request->phone_number, "sms");

            }
            catch (\Twilio\Exceptions\RestException $e) {
                $errorm = "Error sending SMS: ".$e->getCode() . ' : ' . $e->getMessage()."\n"; 
                return redirect()->route('verify.show')->with(['errorm'=>$errorm,'phone_no'=>$request->phone_number]);
                // echo "Error sending SMS: ".$e->getCode() . ' : ' . $e->getMessage()."\n";
            }
                return redirect()->route('verify.show')->with('phone_no',$request->phone_number);
        }
        else{
            return redirect()->route('register')->with('errorm','Register again Phone no field is required');
        }
        
        }    
}
