<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Log;

class TwoFactorController extends Controller
{
    public function setup(Request $request)
    {
        $google2fa = new Google2FA();
        $user = auth()->user();
        $secret = $google2fa->generateSecretKey();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->employee_number,
            $secret
        );

        // Gerar QR Code como SVG
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrCodeUrl);

        return view('auth.2fa_setup', [
            'secret' => $secret,
            'qrCodeSvg' => $qrCodeSvg
        ]);
    }

    public function completeSetup(Request $request)
    {
        $request->validate([
            'secret' => 'required|string',
            'one_time_password' => 'required|string'
        ]);

        $google2fa = new Google2FA();
        $user = auth()->user();
        $otp_secret = $request->input('secret');

        Log::info('Completing 2FA setup for user: ' . $user->employee_number . ' with secret: ' . $otp_secret);

        if (!$google2fa->verifyKey($otp_secret, $request->one_time_password)) {
            return back()->withErrors(['one_time_password' => 'The one time password is invalid.']);
        }

        $user->google2fa_secret = $otp_secret;
        $user->uses_two_factor_auth = true;
        $user->save();

        Log::info('2FA setup complete for user: ' . $user->employee_number);

        return redirect()->route('home')->with('success', '2FA setup complete.');
    }

    public function showVerifyForm()
    {
        return view('auth.2fa_verify');
    }

    public function verify(Request $request)
    {
        $request->validate(['one_time_password' => 'required|string']);

        $user = Auth::user();

        if (!$user || !$user->uses_two_factor_auth || !$user->google2fa_secret) {
            return redirect()->route('2fa.setup'); //route('/2fa/setup');
        }

        $google2fa = new Google2FA();
        $otp_secret = $user->google2fa_secret;

        if (!$google2fa->verifyKey($otp_secret, $request->one_time_password)) {
            throw ValidationException::withMessages([
                'one_time_password' => [__('The one time password is invalid.')],
            ]);
        }

        // Store the 2FA verified status in the session
        $request->session()->put('2fa:user:id', $user->id);

        // Optionally, you can store remember me token
        $remember = $request->boolean('remember');
        Auth::login($user, $remember);

        return redirect()->intended('/home');
    }
}
