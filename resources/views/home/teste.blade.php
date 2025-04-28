<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats - App Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat/chat.css') }}">
    
</head>
<body>
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h4>Conversas</h4>
                <button class="profile-btn" id="profileBtn">
                    <img src="{{ $user->imagemPerfil ?? asset('images/defaultPPF.jpg') }}" alt="Profile" class="profile-img">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            
            <div class="search-bar">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Pesquisar conversas">
            </div>
            
            {{-- <ul class="conversation-list">
                <!-- Conversa 1 -->
                <li class="conversation-item active">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Ana Silva</span>
                            <span class="conversation-time">10:30</span>
                        </div>
                        <p class="conversation-preview">Ótimo, então nos vemos amanhã!</p>
                    </div>
                    <div class="unread-badge">3</div>
                </li>
                
                <!-- Conversa 2 -->
                <li class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Carlos Oliveira</span>
                            <span class="conversation-time">Ontem</span>
                        </div>
                        <p class="conversation-preview">Você já viu o novo projeto?</p>
                    </div>
                </li>
                
                <!-- Conversa 3 -->
                <li class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Grupo de Trabalho</span>
                            <span class="conversation-time">Seg</span>
                        </div>
                        <p class="conversation-preview">Marcos: Precisamos marcar uma reunião</p>
                    </div>
                    <div class="unread-badge">5</div>
                </li>
                
                <!-- Mais conversas... -->
                <li class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Ricardo Almeida</span>
                            <span class="conversation-time">Dom</span>
                        </div>
                        <p class="conversation-preview">Obrigado pela ajuda!</p>
                    </div>
                </li>
                
                <li class="conversation-item">
                    <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="User" class="conversation-avatar">
                    <div class="conversation-content">
                        <div class="conversation-header">
                            <span class="conversation-name">Juliana Costa</span>
                            <span class="conversation-time">Sex</span>
                        </div>
                        <p class="conversation-preview">Mandei os documentos que você pediu</p>
                    </div>
                </li>
            </ul> --}}
        </div>
        
        <!-- Chat Area -->
        {{-- <div class="chat-area">
            <div class="chat-header">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="conversation-avatar">
                <div>
                    <h5 class="mb-0">Ana Silva</h5>
                    <small class="text-muted">Online</small>
                </div>
            </div>
            
            <div class="chat-messages">
                <!-- Mensagem recebida -->
                <div class="message received">
                    <p>Oi! Tudo bem?</p>
                    <div class="message-time">10:15</div>
                </div>
                
                <!-- Mensagem enviada -->
                <div class="message sent">
                    <p>Tudo ótimo! E com você?</p>
                    <div class="message-time">10:16</div>
                </div>
                
                <!-- Mensagem recebida -->
                <div class="message received">
                    <p>Aqui tudo bem também! Você já confirmou se vai conseguir ir amanhã no evento?</p>
                    <div class="message-time">10:20</div>
                </div>
                
                <!-- Mensagem enviada -->
                <div class="message sent">
                    <p>Sim, já confirmei minha presença. Que horas você vai chegar?</p>
                    <div class="message-time">10:25</div>
                </div>
                
                <!-- Mensagem recebida -->
                <div class="message received">
                    <p>Acho que por volta das 14h. Podemos nos encontrar na entrada principal?</p>
                    <div class="message-time">10:28</div>
                </div>
                
                <!-- Mensagem enviada -->
                <div class="message sent">
                    <p>Perfeito! Combinado então.</p>
                    <div class="message-time">10:30</div>
                </div>
                
                <!-- Mensagem recebida -->
                <div class="message received">
                    <p>Ótimo, então nos vemos amanhã!</p>
                    <div class="message-time">10:30</div>
                </div>
            </div>
            
            <div class="chat-input-area">
                <textarea class="chat-input" placeholder="Digite uma mensagem..." rows="1"></textarea>
                <button class="send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div> --}}
        
        <!-- Profile Modal -->
        <div class="profile-modal" id="profileModal">
            <div class="profile-header">
                <h4>Perfil</h4>
                <button class="close-btn" id="closeProfileBtn">
                    <i class="fas fa-times"></i>
                </button>
                
            </div>
            
            <div class="profile-content">
                
            
                <img src="{{ $user->imagemPerfil ?? asset('images/defaultPPF.jpg') }}" alt="Profile" class="profile-img-large">
            
                <h3 class="profile-name">{{ $user->nmUsuario }} {{ $user->sobrenomeUsuario }}</h3>
            
                <span class="profile-status">Online</span>

                <div>
                    Amigos: {{ $qtdAmizades }}
                </div>
            
                <div class="profile-details">
                    <div class="detail-item">
                        <div class="detail-label">E-mail</div>
                        <div class="detail-value">{{ $user->email }}</div>

                    </div>
            
                    <div class="detail-item">
                        <div class="detail-label">Biografia</div>
                        <div class="detail-value">{{ $user->telefone ?? 'Não informado' }}</div>
                    </div>
            
                    {{-- <div class="detail-item">
                        <div class="detail-label">Cargo</div>
                        <div class="detail-value">{{ $user->cargo ?? 'Não informado' }}</div>
                    </div>
            
                    <div class="detail-item">
                        <div class="detail-label">Localização</div>
                        <div class="detail-value">{{ $user->localizacao ?? 'Não informado' }}</div>
                    </div> --}}
                </div>
            
                <form  action="{{ route('LogOut') }}" method="GET">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Abrir/fechar modal de perfil
        const profileBtn = document.getElementById('profileBtn');
        const closeProfileBtn = document.getElementById('closeProfileBtn');
        const profileModal = document.getElementById('profileModal');
        
        profileBtn.addEventListener('click', () => {
            profileModal.classList.add('open');
        });
        
        closeProfileBtn.addEventListener('click', () => {
            profileModal.classList.remove('open');
        });
        
        // Auto-resize do textarea de mensagem
        const chatInput = document.querySelector('.chat-input');
        
        chatInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Selecionar conversa
        const conversationItems = document.querySelectorAll('.conversation-item');
        
        conversationItems.forEach(item => {
            item.addEventListener('click', () => {
                conversationItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                
                // Aqui você pode adicionar lógica para carregar a conversa selecionada
            });
        });
    </script>
</body>
</html>