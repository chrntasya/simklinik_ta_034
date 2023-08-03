<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Roles;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /* Override method showRegistrationForm() on trait RegistersUsers */
    /*
     * Redirect register page to login page
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'unique:users'],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        $input['password'] = Hash::make($params['password']);
        $user = User::create($input);
        $role = Roles::where('nama', 'pasien')->first();
        $params['user_id'] = $user->id;
        $params['role_id'] = $role->id;
        $userRole = UserRole::create($params);
        return redirect()->route('home');
    }
}
