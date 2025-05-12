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
        // token pego automaticamente ainda nao sei pq pelo authorization (pesquisar depois https://stackoverflow.com/questions/68966760/how-to-get-auth-token-automatically-in-laravel-and-vue)
        $user = auth('api')->user();

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

    } catch (\Exception $ex) {
        return response()->json(['success' => false, 'message' => 'Erro: ' . $ex->getMessage()], 500);
    }
}


}
