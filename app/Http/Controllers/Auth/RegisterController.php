<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Mail;

// TODO: Из видео 3 с 3:55 (чуть раньше) - перенести сюда аутентификацию свою из трейта

class RegisterController extends Controller
{


    use RedirectsUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {

        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );

        Mail::to($user->email)->send(new VerifyMail($user));
        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Check your email and click on the link to verify.');
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(string $token)
    {

        if (!$user = User::where('verify_token', $token)->first()) {
            return redirect()
                ->route('login')
                ->with('error', 'Sorry your login cannot be identified.');
        }

        try {
            $user->verify();
        } catch (\DomainException $e) {
            return redirect()->route('login')
                ->with('error', $e->getMessage());
        }


        return redirect()->route('login')
            ->with('success', 'Your email is verified. You can now login.');

    }

}
