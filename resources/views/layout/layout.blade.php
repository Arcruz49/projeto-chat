<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - App Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat/chat.css') }}">
    
    <style>
        :root {
            --primary-color: #8b5cf6;
            --primary-hover: #7c3aed;
            --background-dark: #0f172a;
            --card-dark: #1e293b;
            --text-dark: #e2e8f0;
            --input-dark: #334155;
            --border-dark: #475569;
            --sidebar-dark: #1e293b;
            --chat-dark: #0f172a;
            --unread-badge: #8b5cf6;
        }
        
        body {
            background-color: var(--background-dark);
            color: var(--text-dark);
            height: 100vh;
            font-family: 'Inter', system-ui, sans-serif;
            overflow: hidden;
        }
        
        .chat-container {
            display: flex;
            height: 100vh;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="chat-container">
        <!-- Conteúdo principal -->
        @yield('main-content')
        
        <!-- Componentes adicionais -->
        @stack('components')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>