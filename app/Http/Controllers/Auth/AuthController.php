<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\ActivationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    
    protected $activationService;

    protected $username = 'phone_number';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->activationService = $activationService;
    }


    /*
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        $this->activationService->sendActivationMail($user);

        return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
    }

    */
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|unique:users',
            'birthdate' => 'required',
            'sex' => 'required',
            'img' => 'required|mimes:jpeg,bmp,jpg,png'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(Input::hasFile('img')){
            $file = Input::file('img');
            $file1 = $file->move(public_path().'/img_profil/',$file->GetClientOriginalName());
            $image = $file->GetClientOriginalName();
         }

        return User::create([
            'name' => $data['name'],
            'birthdate' => $data['birthdate'],
            'sex' => $data['sex'],
            'role' => '2',
            'activated'=> 1,
            'phone_number'=>$data['phone_number'],
            'address'=>$data['address'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'img' => '/img_profil/'.$image
        ]);
    }

        public function authenticated(Request $request, $user)
    {
        $now = date("Y-m-d H:i:s");
        $date = strtotime($user->subdate);
        $subdate= strtotime("+7 day", $date);
        $subdate = date("Y-m-d H:i:s", $subdate);

        if ($user->is_login) {
            auth()->logout();
            return back()->with('warning', 'Your account being used by other device. Please logout it fisrt has expired account.');
        }
        if ($subdate <= $now) {
            auth()->logout();
            return back()->with('warning', 'Your subscription has expired account. Now '. $now.' and your subcription date is '.$subdate.' Please buy the subscription again.');
        }
        else if (!$user->activated) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        $user->is_login=1;
        return redirect()->intended($this->redirectPath());
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }

    public function logout(Request $request)
    {
        $user=Auth::user;
        $user->is_login=0;
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
