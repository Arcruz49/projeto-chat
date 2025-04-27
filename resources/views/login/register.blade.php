<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - App Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login/register.css') }}">

    
</head>
<body>
    <div class="signup-container">
        <div class="signup-card">
            <div class="signup-header">
                <h2>Crie sua conta</h2>
                <p>Cadastre-se para continuar</p>
            </div>
            
            <div class="signup-body">
                <form action="{{ route('registerUser') }}" method="post">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3 input-group-icon">
                                <label for="firstName" class="form-label mb-1">Nome</label>
                                <div>
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" class="form-control input-field" id="firstName" name="firstName" placeholder="Seu nome" required>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 input-group-icon">
                                <label for="lastName" class="form-label mb-1">Sobrenome</label>
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="form-control input-field" id="lastName" name="lastName" placeholder="Seu sobrenome" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3 input-group-icon">
                        <label for="email" class="form-label mb-1">E-mail</label>
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control input-field" id="email" name="email"
                               placeholder="seu@email.com" required>
                    </div>
                    
                    <div class="mb-3 input-group-icon">
                        <label for="password" class="form-label mb-1">Senha</label>
                        <i class="fas fa-lock input-icon" style="line-height: 15px"></i>
                        <input type="password" class="form-control input-field" id="password" name="password"
                               placeholder="••••••••" required>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3 input-group-icon">
                        <label for="confirmPassword" class="form-label mb-1">Confirme a Senha</label>
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control input-field" id="confirmPassword" name="confirmPassword"
                               placeholder="••••••••" required>
                    </div>
                    
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="terms" name="terms">
                        <label class="form-check-label" for="terms">
                            Eu concordo com os <a href="#">Termos de Serviço</a> e <a href="#">Política de Privacidade</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-signup mb-3">
                        <i class="fas fa-user-plus me-2"></i> Criar conta
                    </button>
                    
                    <div class="divider">ou cadastre-se com</div>
                    
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-social" type="button">
                            <i class="fab fa-google me-2"></i> Google
                        </button>
                        <button class="btn btn-social" type="button">
                            <i class="fab fa-apple me-2"></i> Apple
                        </button>
                    </div>
                    
                    <div class="text-center mt-3">
                        Já tem uma conta? <a href="{{ route('login') }}" class="fw-medium">Faça login</a>
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
    {{-- <script>
        // Simples validação de força da senha
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length > 0) strength += 20;
            if (password.length >= 8) strength += 30;
            if (/[A-Z]/.test(password)) strength += 15;
            if (/[0-9]/.test(password)) strength += 15;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            strengthBar.style.width = strength + '%';
            
            if (strength < 40) {
                strengthBar.style.backgroundColor = '#ef4444'; // Vermelho
            } else if (strength < 70) {
                strengthBar.style.backgroundColor = '#f59e0b'; // Amarelo
            } else {
                strengthBar.style.backgroundColor = '#10b981'; // Verde
            }
        });
    </script> --}}
</body>
</html>