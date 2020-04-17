<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return redirect()->route('login')
            ->with('success', 'Check Your email and click url to verify');
    }

    public function verify($token)
    {
        $user = User::where('verify_token', $token)->first();
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Sorry/ Your link cannot be identified');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')
                ->with('success', 'Your email is verified. You can now login');
        } catch (\DomainException $e) {
            return redirect()->route('login')
                ->with('error', $e->getMessage());
        }
    }
}
