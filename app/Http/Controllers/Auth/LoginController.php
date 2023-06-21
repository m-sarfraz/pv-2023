<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Attempt to authenticate the user
        $authAttempt = Auth::attempt($credentials, $request->filled('remember'));

        if ($authAttempt) {
            // Check the user's status
            $user = Auth::user();
            if ($user->status == 'true') {
                // User's status is valid, proceed with login
                return true;
            } else {
                // User's status is invalid, log them out and set the status_error message
                $this->guard()->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $request->session()->flash('status_error', 'Failed to login an Inactive User.');

                return false;
            }
        } else {
            // Invalid credentials, set the auth_error message
            $request->session()->flash('auth_error', 'Username and password did not match.'); 

            return false;
        }
    }

}

//             return redirect()->back()->withInput()->withErrors([
//                 'status' => 'Invalid user status.',
//             ]);
// // User's status is invalid, log them out and redirect with an error message
// $this->guard()->logout();
// $request->session()->invalidate();
// $request->session()->regenerateToken();
// $request->session()->flash('status_error', 'User has been marked as Inactive');
