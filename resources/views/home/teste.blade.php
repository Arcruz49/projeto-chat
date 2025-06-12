<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats - App Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat/chat.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div class="chat-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h4>Conversas</h4>
                <button class="profile-btn" id="profileBtn">
                    @if($user->imagemPerfil)
                        <img 
                            src="data:image/jpeg;base64,{{ $user->imagemPerfil }}" 
                            alt="Profile" 
                            class="profile-img">
                    @else
                        <img 
                            src="{{ asset('images/defaultPPF.jpg') }}" 
                            alt="Profile" 
                            class="profile-img">
                    @endif
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
                
            
                <form id="formUpload" action="/uploadProfileImage" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="profileImageInput" name="profileImage" accept="image/*"  >
                    
                    @if($user->imagemPerfil)
                        <img 
                            src="data:image/jpeg;base64,{{ $user->imagemPerfil }}" 
                            alt="Profile" 
                            class="profile-img-large">
                    @else
                        <img 
                            src="{{ asset('images/defaultPPF.jpg') }}" 
                            alt="Profile" 
                            class="profile-img-large">
                    @endif
                </form>
            
                <h3 class="profile-name">{{ $user->nmUsuario }} {{ $user->sobrenomeUsuario }}</h3>
            
                <span class="profile-status">Online</span>

                <div class="profile-friends">
                    Amigos: {{ $qtdAmizades }}
                    <button id="openModalBtn" class="btn">
                        <i class="fas fa-user-plus me-2 text-white"></i> 
                    </button>
                    

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



    <!-- Modal -->
    <div class="friend-request-modal" id="friendRequestModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gerenciar Amizades</h5>
                <button type="button" class="close-btn" id="closeFriendRequestModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <!-- Abas -->
                <ul class="nav nav-tabs" id="friendRequestTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="search-tab" data-bs-toggle="tab" data-bs-target="#search-tab-pane" type="button" role="tab">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests-tab-pane" type="button" role="tab">
                            <i class="fas fa-user-clock me-2"></i>Solicitações
                            {{-- <span class="badge bg-primary ms-2" id="pendingRequestsBadge">2</span> --}}
                        </button>
                    </li>
                </ul>
                
                <!-- Conteúdo das abas -->
                <div class="tab-content" id="friendRequestTabsContent">
                    <!-- Tab Buscar -->
                    <div class="tab-pane fade show active" id="search-tab-pane" role="tabpanel">
                        <div class="search-section mt-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" 
                                       id="friendSearchInput" placeholder="Buscar usuários...">
                                <button class="btn btn-primary" type="button" id="searchFriendBtn">
                                    Buscar
                                </button>
                            </div>
                            
                            <div class="search-results">
                                <div class="list-group" id="searchResultsList">
                                    <!-- Resultados serão inseridos via JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab Solicitações -->
                    <div class="tab-pane fade" id="requests-tab-pane" role="tabpanel">
                        <div class="requests-section mt-3">
                            <div class="list-group" id="requestsList">
                                <!-- Solicitações serão inseridas via JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function () {
            // Elementos do DOM
            const sampleUsers = [
                { id: 1, name: "Ana Silva", avatar: "https://randomuser.me/api/portraits/women/44.jpg" },
                { id: 2, name: "Carlos Oliveira", avatar: "https://randomuser.me/api/portraits/men/22.jpg" },
                { id: 3, name: "Juliana Costa", avatar: "https://randomuser.me/api/portraits/women/33.jpg" }
            ];
        
            const sampleRequests = [
                { id: 101, sender: { name: "Marcos Santos", avatar: "https://randomuser.me/api/portraits/men/32.jpg" }, date: "10/05/2023 14:30" },
                { id: 102, sender: { name: "Patrícia Lima", avatar: "https://randomuser.me/api/portraits/women/68.jpg" }, date: "09/05/2023 09:15" }
            ];
        
            function openModal() {
                $('#friendRequestModal').addClass('show');
                loadPendingRequests();
            }
        
            function closeModal() {
                $('#friendRequestModal').removeClass('show');
            }
        
            function loadPendingRequests() {
                const $requestsList = $('#requestsList');
                $requestsList.empty();

                $.ajax({
                    url: '/getFriendsRequests',
                    method: 'GET',
                    success: function(response) {
                        
                        if (response.content.length > 0) {
                            response.content.forEach(request => {
                                const html = `
                                    <div class="list-group-item">
                                        <div class="user-info">
                                            <img src="data:image/jpeg;base64,${request.imagemPerfil}" class="user-avatar">
                                            <div>
                                                <div>${request.nmUsuario}</div>
                                                <small class="">Enviado em: ${request.dtEnvioSolicitacao}</small>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn-action btn-accept" data-request-id="${request.cdUsuario}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn-action btn-decline" data-request-id="${request.cdUsuario}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                `;
                                $requestsList.append(html);
                            });
                
                            $('#pendingRequestsBadge').text(response.length).show();
                        } else {
                            $requestsList.html(`
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Nenhuma solicitação pendente</p>
                                </div>
                            `);
                            $('#pendingRequestsBadge').hide();
                        }
                
                        $('.btn-accept').off('click').on('click', acceptRequest);
                        $('.btn-decline').off('click').on('click', declineRequest);



                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao buscar lista de solicitações:', error);
                    }
                });

        
                
            }
        
            // function searchUsers() {
            //     const searchTerm = $('#friendSearchInput').val().trim().toLowerCase();
            //     const $resultsList = $('#searchResultsList');
        
            //     if (searchTerm.length > 0) {
            //         const filteredUsers = sampleUsers.filter(user =>
            //             user.name.toLowerCase().includes(searchTerm)
            //         );
            //         displaySearchResults(filteredUsers);
            //     } else {
            //         $resultsList.html('<div class="empty-state"><p>Digite um nome para buscar</p></div>');
            //     }
            // }


            function searchUsers() {
                const searchTerm = $('#friendSearchInput').val().trim();
                const $resultsList = $('#searchResultsList');

                if (searchTerm.length > 0) {
                    $.ajax({
                        url: '/searchUsers',
                        method: 'GET',
                        data: { searchTerm: searchTerm },
                        success: function(response) {
                            displaySearchResults(response.users); // espera-se um JSON com array "users"
                        },
                        error: function(xhr, status, error) {
                            console.error('Erro ao buscar usuários:', error);
                            $resultsList.html('<div class="empty-state"><p>Erro ao buscar usuários</p></div>');
                        }
                    });
                } else {
                    $resultsList.html('<div class="empty-state"><p>Digite um nome para buscar</p></div>');
                }
            }


            function displaySearchResults(users) {
                const $resultsList = $('#searchResultsList');
                $resultsList.empty();
        
                if (users.length > 0) {
                    users.forEach(user => {
                        const html = `
                            <div class="list-group-item">
                                <div class="user-info">
                                    <img src="data:image/jpeg;base64,${user.imagemPerfil}" class="user-avatar">
                                    <span>${user.nmUsuario}</span>
                                </div>
                                <button class="btn-action btn-send" data-user-id="${user.cdUsuario}">
                                    <i class="fas fa-user-plus me-1"></i> Enviar
                                </button>
                            </div>
                        `;
                        $resultsList.append(html);
                    });
        
                    $('.btn-send').off('click').on('click', function() {
                        const userId = $(this).data('user-id');
                        sendFriendRequest(userId);
                    });
                } else {
                    $resultsList.html('<div class="empty-state"><p>Nenhum usuário encontrado</p></div>');
                }
            }

            function sendFriendRequest(userId){
                $.ajax({
                    url: '/sendFriendRequest',
                    method: 'POST',
                    data: { userId: userId },
                    success: function(response) {
                        if(response.success == true)
                        {

                        }
                        else
                        {
                            console.log('error: ' + response.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('error')
                        
                    }
                });
            }
        
            function acceptRequest(e) {
                const $btn = $(e.currentTarget);
                const requestId = $btn.data('request-id');
                const $item = $btn.closest('.list-group-item');
                alert(`Solicitação ${requestId} aceita!`);
                $item.remove();
                updateRequestsCount();
            }
        
            function declineRequest(e) {
                const $btn = $(e.currentTarget);
                const requestId = $btn.data('request-id');
                const $item = $btn.closest('.list-group-item');
                alert(`Solicitação ${requestId} recusada!`);
                $item.remove();
                updateRequestsCount();
            }
        
            function updateRequestsCount() {
                const count = $('#requestsList .list-group-item').length;
        
                if (count > 0) {
                    $('#pendingRequestsBadge').text(count).show();
                } else {
                    $('#pendingRequestsBadge').hide();
                    $('#requestsList').html(`
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Nenhuma solicitação pendente</p>
                        </div>
                    `);
                }
            }
        
            // Event Listeners
            $('#openModalBtn').on('click', openModal);
            $('#closeFriendRequestModal').on('click', closeModal);
            $('#searchFriendBtn').on('click', searchUsers);
            $('#friendSearchInput').on('keypress', function (e) {
                if (e.key === 'Enter') searchUsers();
            });
        
            // Inicialização
            loadPendingRequests();
        
        
            // Modal de perfil
            $('#profileBtn').on('click', () => {
                $('#profileModal').addClass('open');
            });
        
            $('#closeProfileBtn').on('click', () => {
                $('#profileModal').removeClass('open');
            });
        
            // Auto resize textarea
            $('.chat-input').on('input', function () {
                $(this).css('height', 'auto').css('height', this.scrollHeight + 'px');
            });
        
            // Selecionar conversa
            $('.conversation-item').on('click', function () {
                $('.conversation-item').removeClass('active');
                $(this).addClass('active');
                // Lógica adicional aqui
            });
        });

        $(document).ready(function() {
            $('#profileImage').on('click', function() {
                $('#profileImageInput').click();
            });

            $('#profileImageInput').on('change', function() {
                var formData = new FormData();
                formData.append('profileImage', $('#profileImageInput')[0].files[0]);
                $.ajax({
                    url: "{{ route('UploadProfileImage') }}",
                    type: 'POST',
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                    },
                    success: function(response) {
                        alert('Imagem atualizada com sucesso!');
                        location.reload(); 
                    },
                    error: function(xhr) {
                        alert('Erro ao enviar imagem');
                        console.log(xhr.responseText);
                    }
                });
            });
        });



        $('#profileImage').on('click', function() {
            $('#fileInput').click();
        });

        
    </script>
        
</body>
</html>