<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;
use App\Models\Roles;
use App\Notifications\ObatNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /* Override method authenticated() on trait AuthenticatesUsers */
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // TODO: Uncomment if role management plugin has applied
//        if ($user->hasAnyRole(['admin', 'dokter', 'pasien'])) {
//            if ($user->hasRole('admin')) {
//                return redirect()->route('home');
//            } elseif ($user->hasRole('dokter')) {
//                return redirect()->route('dokter_home');
//            } elseif ($user->hasRole('pasien')) {
//                return redirect()->route('pasien_home');
//            }
//        }
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials))
        {
            $session = $request->session()->regenerate();
            $userId = Auth::user()->id;
            $userRole = UserRole::with(['roles'])->where('user_id', $userId)->first();
            if ($userRole->roles->nama == 'pasien') {
                return redirect()->route('pasien_home');
            } else if ($userRole->roles->nama == 'dokter') {
                return redirect()->route('dokter_home');
            }else if ($userRole->roles->nama == 'apoteker') {
                $now = Carbon::parse(now())->format('Y-m-d');
                $obat = Obat::where('tanggal_kadaluarsa','<',$now)->get();
                
                foreach ($obat as $item) {
                    Notification::send(auth()->user(),new ObatNotification(auth()->user()->id,'Obat '.$item->nama. ' pada rak'. $item->lokasi .' telah expired'));    
                }                
               
                return redirect()->route('apoteker_home');
            }elseif ($userRole->roles->nama == 'laboratorium') {
                return redirect()->route('laboratorium_home');
            }

            return redirect()->route('home');
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}
