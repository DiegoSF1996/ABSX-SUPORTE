<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function sair()
    {
        echo "asdsa";
    }
    function logar(Request $req)
    {
        $req = $req->All();

        try {
            $oUsuario = User::where('usu_email', $req['usu_email'])->get()->first();
            if ($oUsuario) {

                Auth::login($oUsuario);
                Auth::viaRemember();
                // return response()->json(["ss" => 2], 200);
                if (Auth::check()) {
                    Auth::viaRemember();
                    return response()->json(["mensagem" => 1, "dadosUsuario" => Auth::user()], 200);
                } else {
                    return response()->json(["mensagem" => 2], 200);
                }
            } else {
                return response()->json(["mensagem" => 2], 200);
            }
        } catch (\Exception $e) {
            return response()->json(["error" => 1], 200);
        }
    }
    function verficarLogado()
    {
        Auth::viaRemember();

        if (Auth::check()) {
            return response()->json(Auth::user(), 200);
        } else {

            return response()->json(null, 200);
        }
    }
}
