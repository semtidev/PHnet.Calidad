<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Start the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Locked Screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function locked()
    {
        return view('auth.locked');
    }

    /**
     * Unlocked Screen.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function unlocked(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $admin_pwd = User::where('email', 'jmachadog@ecm4hab.co.cu')->first()->password;
        $form_pwd  = Hash::make($request->password);
        //return $admin_pwd . '<br>' . $form_pwd;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $response = array(
                'success' => true
            );
        }
        else {
            $response = array(
                'success' => false,
                'errors' => 'Error'
            );
        }
        return response()->json($response,200);
    }

    /**
     * Change User Password.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $email   = User::where('id', $request->user)->first()->email;
        $newpass = Hash::make($request->new_pass);

        if (Auth::attempt(['email' => $email, 'password' => $request->old_pass])) {
            
            $user = User::find($request->user)->update([
                'password' => $newpass
            ]);

            $response = array(
                'success' => true
            );
        }
        else {
            $response = array(
                'success' => false,
                'message' => 'La Contraseña actual es Incorrecta. Por favor, inténtelo nuevamente.'
            );
        }
        return response()->json($response,200);
    }
}
