<?php

namespace App\Http\Controllers;
use App\Models\CadUsuario;

use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CadUsuarioAmizade;


use View;

class HomeController extends Controller
{
    public function Index(){
        $user = session()->get('user');
    
        if ($user) {

            $qtdAmizades = $this->GetFriendsCount($user);
            return view('home.teste', compact('user', 'qtdAmizades'));
        }
    
        return redirect()->route('login')->with('error', 'Você precisa fazer login.');
    }

    public function GetFriendsCount($user){

        if ($user) {
            $qtdAmizades = CadUsuarioAmizade::where(function($query) use ($user) {
                $query->where('cdUsuarioEnvioSolicitacao', $user->cdUsuario)
                      ->orWhere('cdUsuarioRecebeuSolicitacao', $user->cdUsuario);
            })
            ->where('cdStatusSolicitacao', 2) 
            ->count();
    
            return $qtdAmizades;
        }

        return 0;
    }

    public function SearchUsers(Request $request)
    {
        try {
            $searchTerm = $request->input('searchTerm'); // busca da query string
            $user = CadUsuario::where('email', $searchTerm)->first();
            return response()->json(['users' => $user ? [$user] : []]);

            // dd(response()->json(['users' => $user ? [$user] : []]));
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao buscar usuários'], 500);
        }
    }

    public function SendFriendRequest(Request $request){

        try{
            
        $userIdReceive = $request->input('userId'); 
        $user = session()->get('user');


        $dados = [
            'cdUsuarioEnvioSolicitacao' => $user->cdUsuario,
            'cdUsuarioRecebeuSolicitacao' => $userIdReceive,
            'cdStatusSolicitacao' => 1,
            'dtEnvioSolicitacao' => now(), 
            'dtRespostaSolicitacao' => null,
        ];


        CadUsuarioAmizade::create($dados);
        return response()->json([
            'success' => true,
            'message' => 'Solicitação enviada'
        ]);        
        }
        catch(Exception $ex){
            return response()->json(['message' => 'Erro ao enviar a solicitação: ' . $ex->getMessage()], 500);
        }
    }
    
}
