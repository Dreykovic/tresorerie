<?php

namespace App\Http\Controllers;

use App\Models\Tresorier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class TresorierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tresorier $tresorier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tresorier $tresorier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_password(Request $request, Tresorier $tresorier)
    {
        try {
            $this->validate($request, [

                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
                'tresorier' => 'required'
            ]);

            $tresorier_id = Crypt::decryptString($request->tresorier);
            $tresorier = Tresorier::find($tresorier_id);
            $user = $tresorier->user;
            $status = Password::reset(
             [   $user->id, $request->password, $request->password_confirmation  ],
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();
                    session()->regenerate();


                    event(new PasswordReset($user));
                    Auth::logoutOtherDevices($password);
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return response()->json(['message' => __(' Votre mot de passe a été mis à jour avec succes .'), 'ok' => true]);
            } else {
                // return response()->json(['error' => __('Password reset failed.'), 'ok' => false], 422);
                return response()->json(['message' => 'Une erreur est survenu. Verifiez les information entrées', 'ok' => false]);
            }
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => 'Une erreur s\'est produite. Veuillez réessayer.']);
        }

     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tresorier $tresorier)
    {
        //
    }
}
