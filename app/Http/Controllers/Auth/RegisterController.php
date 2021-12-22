<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Office;
use App\Models\Employee;
use App\Rules\RegisterStoreTrap;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'account-approval';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        $offices = Office::get();
        return view('auth.register', compact('offices'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(strtolower($data['middlename']) == 'n/a' || strtolower($data['middlename']) == 'na' || strtolower($data['middlename']) == 'none') {
            $data['middlename'] = '';
        }

        return Validator::make($data, [
            'email' => ['email', 'required'],
            'firstname'  => ['required', 'string', 'regex:/^[a-zA-Z ].+$/u', 'max:100', new RegisterStoreTrap($data)],
            'middlename' => ['required', 'string', 'regex:/^[a-zA-Z ].+$/u', 'min : 2', 'max:100', new RegisterStoreTrap($data)],
            'lastname'   => ['required', 'string', 'regex:/^[a-zA-Z ].+$/u', 'max:100', new RegisterStoreTrap($data)],
            'suffix'     => ['nullable', 'string', 'max:10',  new RegisterStoreTrap($data)],
            'username'   => ['required', 'string', 'max:50', 'alpha_num', 'unique:users'],
            'password'   => ['required', 'min:8', 'confirmed'],
            'mobile_no' => ['required', 'regex:/^(09|\+639)\d{9}$/', 'unique:users,mobile_no'],
            'date_of_birth' => ['required', 'date'],
            'office' => 'required|exists:offices,office_code',
            'office_detailed' => 'required|exists:offices,office_code',
        ], [], [
            'mobile_no' => 'mobile number',
            'date_of_birth' => 'date of birth',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'firstname'  => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname'   => $data['lastname'],
            'suffix'     => (strtolower($data['suffix']) == 'n/a') ? '' : $data['suffix'],
            'username'   => html_entity_decode($data['username']),
            'password'   => bcrypt($data['password']),
            'mobile_no'  => $data['mobile_no'],
            'email'      => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'office_code' => $data['office'],
            'office_detailed' => $data['office_detailed'],
        ]);
    
        Employee::create([
            'firstname'  => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname'   => $data['lastname'],
            'extension' => $data['suffix'],
            'date_birth' => $data['date_of_birth'],
            'email_address' => $data['email'],
            'user_id' => $user->id,
            'mobile_no' => $data['mobile_no'],
            'office' => $data['office'],
        ]);

        return $user;


        
    }
}
