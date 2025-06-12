<?php

namespace App\Http\Controllers;
use App\Models\CadUsuario;

use Exception;
use Illuminate\Http\Request;
use App\Models\CadUsuarioAmizade;
use Illuminate\Support\Facades\DB;



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

    public function UploadProfileImage(Request $request){
        // $request->validate([
        // 'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        //dd($request->file('profileImage'));
        $user = session()->get('user');

        $file = $request->file('profileImage');
        $imageData = base64_encode(file_get_contents($file));
        $user->imagemPerfil = $imageData;
        $user->save();

        return back()->with('success', 'Imagem atualizada com sucesso!');
    }

    public function GetFriendsRequests(){
        //const sampleRequests = [
              //  { id: 101, sender: { name: "Marcos Santos", avatar: "https://randomuser.me/api/portraits/men/32.jpg" }, date: "10/05/2023 14:30" },
                //{ id: 102, sender: { name: "Patrícia Lima", avatar: "https://randomuser.me/api/portraits/women/68.jpg" }, date: "09/05/2023 09:15" }
            //];

        $user = session()->get('user');

        $query = DB::table('cadusuario_amizade as a')
            ->leftJoin('cadusuario as b', 'a.cdUsuarioEnvioSolicitacao', '=', 'b.cdUsuario')
            ->where('a.cdUsuarioRecebeuSolicitacao', $user->cdUsuario)
            ->select('b.nmUsuario', 'b.imagemPerfil', 'a.dtEnvioSolicitacao', 'b.cdUsuario')
            ->get();

        return response()->json(['content' => $query, 'cdusuario' => $user->cdUsuario]);

    }
    
}
