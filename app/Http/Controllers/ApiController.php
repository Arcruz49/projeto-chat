<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CadStatusSolicitacao;
use App\Models\CadUsuario;
use App\Models\CadUsuarioAmizade;
use App\Models\CadMensagem;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\LoginController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Exception;
use Intervention\Image\Facades\Image;


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

        } catch (Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Erro: ' . $ex->getMessage()], 500);
        }
    }

    public function GetFriendsRequests(){

        $user = auth('api')->user();

        $query = DB::table('cadusuario_amizade as a')
            ->leftJoin('cadusuario as b', 'a.cdUsuarioEnvioSolicitacao', '=', 'b.cdUsuario')
            ->where('a.cdUsuarioRecebeuSolicitacao', $user->cdUsuario)
            ->where('a.cdStatusSolicitacao', CadStatusSolicitacao::where('descStatus', 'Pendente')->value('cdStatusSolicitacao'))
            ->select('a.cdusuario_Amizade', 'b.nmUsuario', 'b.imagemPerfil', 'a.dtEnvioSolicitacao', 'b.cdUsuario')
            ->get();

        return response()->json(['content' => $query, 'cdusuario' => $user->cdUsuario]);

    }

    public function GetChats()
        {
        try {
            $user = auth('api')->user();
            $userId = $user->cdUsuario;

            $chats = DB::table('cadusuario_amizade as a')
                ->where('a.cdStatusSolicitacao', 2)
                ->where(function($query) use ($userId) {
                    $query->where('a.cdUsuarioRecebeuSolicitacao', $userId)
                        ->orWhere('a.cdUsuarioEnvioSolicitacao', $userId);
                })
                ->select(
                    // Aqui seleciona o ID do amigo, que é o usuário diferente do usuário logado
                    DB::raw("CASE 
                        WHEN a.cdUsuarioEnvioSolicitacao = $userId THEN a.cdUsuarioRecebeuSolicitacao
                        ELSE a.cdUsuarioEnvioSolicitacao
                    END as cdUsuarioAmigo"),
                    'a.dtRespostaSolicitacao'
                )
                // Faz join com a tabela de usuários para pegar os dados do amigo
                ->join('cadusuario as b', function($join) use ($userId) {
                    $join->on('b.cdUsuario', '=', DB::raw("CASE 
                        WHEN a.cdUsuarioEnvioSolicitacao = $userId THEN a.cdUsuarioRecebeuSolicitacao
                        ELSE a.cdUsuarioEnvioSolicitacao
                    END"));
                })
                ->groupBy('cdUsuarioAmigo', 'b.nmUsuario', 'a.dtRespostaSolicitacao', 'b.imagemPerfil')
                ->selectRaw('b.nmUsuario, b.imagemPerfil')
                ->get();

            return response()->json(['success' => true, 'content' => $chats]);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }


    public function SearchUsers(Request $request)
    {
        try {
            $searchTerm = $request->input('searchTerm'); 
            $user = CadUsuario::where('email', $searchTerm)->select('cdUsuario','nmUsuario', 'imagemPerfil')->first();
            return response()->json(['users' => $user ? [$user] : []]);

            // dd(response()->json(['users' => $user ? [$user] : []]));
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao buscar usuários' . $e->getMessage()], 500);
        }
    }

    public function SendFriendRequest(Request $request){

        try{
            
            $userIdReceive = $request->input('userId'); 
            $user = auth()->user();


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
            return response()->json(['success' => false, 'message' => 'Erro ao enviar a solicitação: ' . $ex->getMessage()], 500);
        }
    }

    public function AcceptFriendRequest(Request $request){

        try
        {
            $requestId = $request -> input('requestId');
            if($requestId == null || $requestId == 0) throw new Exception('código inválido');

            $cadUsuarioAmizade = CadUsuarioAmizade::where('cdusuario_Amizade', $requestId)->first();
            $cadUsuarioAmizade->cdStatusSolicitacao = CadStatusSolicitacao::where('descStatus', 'Aceito')->value('cdStatusSolicitacao');
            $cadUsuarioAmizade->dtRespostaSolicitacao = now();
            $cadUsuarioAmizade->save();

            return response()->json([
            'success' => true,
            'message' => 'Solicitação aceita'
            ]);      
        }
        catch(Exception $ex)
        {
            return response()->json(['success' => false, 'message' => 'Erro ao aceitar a solicitação: ' . $ex->getMessage()], 500);
        }
    }

    public function RejectFriendRequest(Request $request){

        try
        {
            $requestId = $request -> input('requestId');
            if($requestId == null || $requestId == 0) throw new Exception('código inválido');

            $cadUsuarioAmizade = CadUsuarioAmizade::where('cdusuario_Amizade', $requestId)->first();
            $cadUsuarioAmizade->cdStatusSolicitacao = CadStatusSolicitacao::where('descStatus', 'Recusado')->value('cdStatusSolicitacao');
            $cadUsuarioAmizade->dtRespostaSolicitacao = now();
            $cadUsuarioAmizade->save();

            return response()->json([
            'success' => true,
            'message' => 'Solicitação recusada'
            ]);      
        }
        catch(Exception $ex)
        {
            return response()->json(['success' => false, 'message' => 'Erro ao recusar a solicitação: ' . $ex->getMessage()], 500);
        }
    }


    public function RegisterUser(Request $req) {
        try {
            $loginController = new LoginController();

            $retorno = $loginController->ValidateForm($req);
            
            if ($retorno['success'] != true) {
                return response()->json($retorno);
            }

            $verificacaoEmail = $loginController->VerifyEmail($req->input('email'));
            
            if ($verificacaoEmail['success'] != true) {
                return response()->json($verificacaoEmail);
            }

            // resto do código
            $dados = [
                'nmUsuario' => $req->input('firstName'),
                'sobrenomeUsuario' => $req->input('lastName'),
                'email' => $req->input('email'),
                'senha' => bcrypt($req->input('password')),
                'dtCriacao' => now(),
            ];

            CadUsuario::create($dados);

            return response()->json([
                'success' => true,
                'message' => 'Usuário Registrado',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro ao registrar o usuário. Tente novamente.',
                'error' => $e->getMessage()
            ]);
        }
    }


    public function UploadProfileImage(Request $request)
    {
        // 1. Obter o usuário autenticado
        // Usando 'auth('api')->user()' conforme seu exemplo recente.
        $user = auth('api')->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuário não autenticado.'], 401);
        }

        // 2. Obter a string Base64 da imagem do corpo JSON da requisição
        // Seu aplicativo React Native envia isso como 'imagemPerfil' no corpo JSON.
        $base64Image = $request->json('imagemPerfil');

        // Validação básica para a string Base64
        if (empty($base64Image)) {
            return response()->json(['success' => false, 'message' => 'Dados da imagem Base64 vazios.'], 400);
        }

        // --- ATENÇÃO IMPORTANTE ---
        // 3. Salvar a string Base64 diretamente na coluna do banco de dados.
        // CUIDADO: Armazenar imagens como strings Base64 diretamente no banco de dados
        // não é a prática mais recomendada para imagens grandes.
        // Isso pode aumentar o tamanho do banco de dados rapidamente, afetar o desempenho
        // de leitura/escrita e pode exceder limites de tamanho de coluna (como VARCHAR/TEXT).
        // Para imagens grandes, a prática recomendada é salvar o arquivo no sistema de arquivos
        // (como o Storage do Laravel) e armazenar o caminho/URL no banco de dados.
        // No entanto, para atender à sua solicitação explícita, estamos fazendo isso.
        $user->imagemPerfil = $base64Image;

        try {
            $user->save();
        } catch (Exception $e) {
            // Registre o erro para depuração
            return response()->json(['success' => false, 'message' => 'Erro interno do servidor ao salvar imagem no banco de dados.' . $e->getMessage()], 500);
        }

        // 4. Retornar resposta de sucesso
        return response()->json(['success' => true, 'message' => 'Imagem de perfil atualizada e salva no banco de dados!']);
    }



    public function OpenChat($cdUsuarioAmigo)
    {
        $user = auth('api')->user();
        $cdUsuarioLogado = $user->cdUsuario;
        
        $mensagens = CadMensagem::where(function ($query) use ($cdUsuarioLogado, $cdUsuarioAmigo) {
                $query->where('cdUsuarioEnvio', $cdUsuarioLogado)
                      ->where('cdUsuarioRecebeu', $cdUsuarioAmigo);
            })
            ->orWhere(function ($query) use ($cdUsuarioLogado, $cdUsuarioAmigo) {
                $query->where('cdUsuarioEnvio', $cdUsuarioAmigo)
                      ->where('cdUsuarioRecebeu', $cdUsuarioLogado);
            })
            ->orderBy('dtEnvio', 'desc')
            ->get();
        return response()->json($mensagens);
    }

    public function SendMessage(Request $request)
    {


        try{
            $user = auth('api')->user();

            if (!$user) {
                return response()->json(['erro' => 'Usuário não autenticado'], 401);
            }

            $cdUsuarioLogado = $user->cdUsuario;

            $request->validate([
                'cdUsuarioRecebeu' => 'required|integer',
                'descMensagem' => 'required|string|max:1000'
            ]);

            $mensagem = CadMensagem::create([
                'cdUsuarioEnvio' => $cdUsuarioLogado,
                'cdUsuarioRecebeu' => $request->cdUsuarioRecebeu,
                'descMensagem' => $request->descMensagem,
                'visualizado' => 0,
                'dtEnvio' => now(), 
            ]);

            return response()->json(['success' => true, 'message' => 'mensagem enviada com sucesso']);
        }
        catch(Exception $ex){
            return response()->json(['success' => false, 'error' => 'erro ao enviar mensagem'.$ex->getMessage()]);
        }
        
    }



}
