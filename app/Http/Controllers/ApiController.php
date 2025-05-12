<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CadUsuario;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public function AlterarSenha(Request $req)
    {

        try {
            // Autenticacao do usuario com o token jwt
            $user = auth('api')->setToken($req->token)->user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Token inválido.'], 401);
            }

            
            if (!\Hash::check($req->oldPass, $user->senha)) {
                return response()->json(['success' => false, 'message' => 'Senha atual incorreta.'], 400);
            }

            if ($req->newPass != $req->confirmNewPass) {
                return response()->json(['success' => false, 'message' => 'Senhas não coincidem.'], 400);
            }

            $user->senha = bcrypt($req->newPass);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Senha alterada com sucesso!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro: ' . $e->getMessage()], 500);
        }
    }

}
