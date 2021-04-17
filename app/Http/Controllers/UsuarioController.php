<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use function GuzzleHttp\Psr7\try_fopen;

class UsuarioController extends Controller
{
    function salvar(Request $req)
    {

        $req = $req->all();

        if (isset($req['usu_codigo']) && $req['usu_codigo']) {
            try {
                $oUsuario = User::find($req['usu_codigo']);
                $oUsuario->usu_status = $req['usu_status'];
                $oUsuario->usu_nome = $req['usu_nome'];
                $oUsuario->usu_email = $req['usu_email'];
                $oUsuario->usu_telefone = $req['usu_telefone'];
                $oUsuario->usu_tipousuario = $req['usu_tipousuario'];
                if($oUsuario->save()){
                    return response()->json($oUsuario, 200);
                }
            } catch (\Exception $e) {
                return response()->json($e, 200);
            }
        } else {
            try {

                User::create($req);
            } catch (\Exception $e) {
                return response()->json($e, 200);
            }
        }
    }
    function lsUsuarioPorFiltro(Request $req)
    {
        // $oUsuarios = User::All();
        $req = $req->All();

        $oUsuarios = User::orderBy('usu_codigo');


        if (isset($req['usu_codigo'])) {
            $oUsuarios =  $oUsuarios->where('usu_codigo', $req['usu_codigo']);
        }
        if (isset($req['usu_status'])) {
            $oUsuarios =  $oUsuarios->where('usu_status', $req['usu_status']);
        }


        return response()->json($oUsuarios->get(), 200);
    }
    function excluirUsuario(Request $req)
    {
        $usuarios = $req->All();

        foreach ($usuarios as $usuario) {
            if (isset($usuario['usu_check']) && $usuario['usu_check'] == true) {

                $usu = User::find($usuario['usu_codigo'])->delete();
            }
        }
        return response()->json();
    }
}
