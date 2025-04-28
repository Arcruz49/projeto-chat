<?php

namespace App\Http\Controllers;
use App\Models\CadUsuario;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function Index(){
        return view("login.index");
    }

    public function Register(){
        return view("login.register");
    }

    public function RegisterUser(Request $req) {
        try {
            $retorno = $this->ValidateForm($req);
            
            if ($retorno['success'] != true) {
                return response()->json($retorno);
            }

            $verificacaoEmail = $this->VerifyEmail($req->input('email'));
            
            if ($verificacaoEmail['success'] != true) {
                return response()->json($verificacaoEmail);
            }

            $dados = [
                'nmUsuario' => $req->input('firstName'),
                'sobrenomeUsuario' => $req->input('lastName'),
                'email' => $req->input('email'),
                'senha' => bcrypt($req->input('password')),
                'dtCriacao' => now(),
            ];
    
            CadUsuario::create($dados);
    
            return view("login.index");
    
        } 
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro ao registrar o usuário. Tente novamente.',
                'error' => $e->getMessage()
            ]);
        }
    }
    

    public function ValidateForm(Request $req){
        $retorno = [
            'success' => true,
            'message' => ''
        ];
    
        if (empty($req->input('firstName'))) {
            $retorno['success'] = false;  
            $retorno['message'] = 'Nome inválido';  
            return $retorno;
        }

        if (empty($req->input('lastName'))) {
            $retorno['success'] = false;  
            $retorno['message'] = 'Sobrenome inválido';  
            return $retorno;  
        }

        if (empty($req->input('email'))) {
            $retorno['success'] = false;  
            $retorno['message'] = 'Email inválido';  
            return $retorno;  
        }

        if (empty($req->input('password'))) {
            $retorno['success'] = false;  
            $retorno['message'] = 'Senha inválida';  
            return $retorno;  
        }

        if ($req->input('password') !== $req->input('confirmPassword')) {
            $retorno['success'] = false;  
            $retorno['message'] = 'As senhas não coincidem';  
            return $retorno;  
        }
    
    
        return $retorno;  
    }
    
    public function VerifyEmail(string $email)
    {
        try
        {
            $user = CadUsuario::where('email', $email)->first();
            if ($user) {
                return ['success' => false, 'message' => 'Email já registrado'];  
            } else {
                return ['success' => true, 'message' => ''];  
            }
        }
        catch(\Exception $e)
        {
            return ['success' => false, 'message' => 'Erro ao validar email: ' . $e->getMessage()];  
        }
    }

    public function LoginUser(Request $req)
    {

        try {
            $req->validate([
                'email' => 'required|email',  
                'password' => 'required', 
            ]);

            $user = CadUsuario::where('email', $req->input('email'))->first();



            if ($user && Hash::check($req->input('password'), $user->senha)) {
                Auth::login($user); 


                session(['user' => $user]); 

                return redirect()->route('Home');

                // return response()->json([
                //     'success' => true,
                //     'message' => 'Login bem-sucedido.',
                //     'user' => $user 
                // ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciais inválidas.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao tentar fazer login: ' . $e->getMessage()
            ]);
        }
    }

    public function LogOut()
    {
        Auth::logout();

        Session::flush();

        return redirect()->route('login');
    }
}
