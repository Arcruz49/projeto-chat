<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - App Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">

</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Acesse sua conta</h2>
                <p>Entre para continuar</p>
            </div>
            
            <div class="login-body">
                <form action="{{ route('loginUser') }}" method="post">
                    @csrf
                    
                    <div class="mb-3 input-group-icon">
                        <label for="email" class="form-label mb-1">E-mail</label>
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control input-field" id="email" name="email" 
                               placeholder="seu@email.com" required>
                    </div>
                    
                    <div class="mb-4 input-group-icon">
                        <label for="password" class="form-label mb-1">Senha</label>
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control input-field" id="password" name="password" 
                               placeholder="••••••••" required>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Lembrar-me</label>
                        </div>
                        <a href="#" class="text-decoration-none">Esqueceu a senha?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-login mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i> Entrar
                    </button>
                    
                    <div class="divider">ou continue com</div>
                    
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-social" type="button">
                            <i class="fab fa-google me-2"></i> Google
                        </button>
                        <button class="btn btn-social" type="button">
                            <i class="fab fa-apple me-2"></i> Apple
                        </button>
                    </div>
                    
                    <div class="text-center mt-3">
                        Não tem uma conta? <a href="{{ route('register') }}" class="fw-medium">Cadastre-se</a>
                    </div>
                    
                    <div class="footer-links">
                        <a href="#">Termos</a>
                        <a href="#">Privacidade</a>
                        <a href="#">Ajuda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>