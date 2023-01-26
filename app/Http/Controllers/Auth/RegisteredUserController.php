<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Twilio\Rest\Client; 
use Session;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // $isConn = $this->isConnected(true);
        // var_dump($isConn);exit();
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
    //  */
    public function store(Request $request)
    {
                $request->validate([
                        'name' => ['required',],
                        'email' => ['required'],
                        'password' => ['required',],
                    ]);
            
            if (is_numeric($request->email)) {
                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required','numeric' ,'unique:users'],
                        'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    ]);
                    //Store user register data and store value in verifystore method
                    session::put('user_detail', $request->all());
                    // var_dump(session::get('user_detail'));exit();

                        $token = getenv("TWILIO_AUTH_TOKEN");
                        $twilio_sid = getenv("TWILIO_SID");
                        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
                        $twilio = new Client($twilio_sid, $token);
                        try {
                            $twilio->verify->v2->services($twilio_verify_sid)->verifications->create($request->email, "sms");   
                        } catch (\Twilio\Exceptions\RestException $e) {
                            $errorm = "Error sending SMS: ".$e->getCode() . ' : ' . $e->getMessage()."\n"; 
                            return redirect()->route('register')->with(['errorm'=>$errorm]);
                        }
                        
                        // $user = User::insert([
                        //     'name' => $request->name,
                        //     'email' => $request->email,
                        //     'password' => Hash::make($request->password),
                        // ]);
                        // Auth::login($user);
                        return redirect()->route('verify.show')->with('phone_no',$request->email);      
                }
                elseif (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required','email' ,'string','unique:users'],
                        'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    ]);
                        $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);

                    event(new Registered($user));

                    Auth::login($user);
                    return redirect(RouteServiceProvider::HOME);                 
                }
                else{
                    return redirect()->route('register')->with('registraionError','Only Accept Email Or Phone Number');
                }
            

            
        }    
    }
