<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Services\Sms\SmsSender;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PhoneController extends Controller
{

    /**
     * @var SmsSender
     */
    private $sender;

    public function __construct(SmsSender $sender)
    {
        $this->sender = $sender;
    }

    public function request(Request $request)
    {
        $user = Auth::user();
        try {
            $token = $user->requestPhoneVerification(Carbon::now());
            $this->sender->send($user->phone, 'Phone verification token: ' . $token);
        } catch (\DomainException $e) {
            $request->session()->flash('error', $e->getMessage());
        }

        return redirect()->route('cabinet.profile.phone');
    }

    public function form()
    {
        $user = Auth::user();

        return view('cabinet.profile.phone', compact('user'));
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        try {
            $user->verifyPhone($request['token'], Carbon::now());
        } catch (\DomainException $e) {
            return redirect()->route('cabinet.profile.phone')->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.profile.home');
    }

    public function auth()
    {

        $user = Auth::user();


        try {
            if ($user->isPhoneAuthEnabled()) {
                $user->disablePhoneAuth();
            } else {
                $user->enablePhoneAuth();
            }
        } catch (\DomainException $e) {
            return redirect()->route('cabinet.profile.home')->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.profile.home');
    }
}
