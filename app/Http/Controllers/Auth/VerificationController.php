<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\WelcomeEmailJob;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function verify(Request $request, $id, $hash)
    {
            $client = User::findOrFail($id);
            if (!hash_equals((string) $hash, sha1(
                $client->getEmailForVerification()
            ))) {
                throw new AuthorizationException();
            }
            if ($client->markEmailAsVerified()) {
                WelcomeEmailJob::dispatch($client);
            }
            return response()->json([
                'message' => 'Email verified successfully'
            ]);
        
    }

}
