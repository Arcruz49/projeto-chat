<div class="profile-modal" id="profileModal">
    <div class="profile-header">
        <h4>Meu Perfil</h4>
        <button class="close-btn" id="closeProfileBtn">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="profile-content">
        <img src="{{ $user['avatar'] ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}" alt="Profile" class="profile-img-large">
        <h3 class="profile-name">{{ $user['name'] ?? 'Usuário' }}</h3>
        <span class="profile-status">{{ $user['status'] ?? 'Online' }}</span>
        
        <div class="profile-details">
            @isset($user['details'])
                @foreach($user['details'] as $detail)
                    <div class="detail-item">
                        <div class="detail-label">{{ $detail['label'] }}</div>
                        <div class="detail-value">{{ $detail['value'] }}</div>
                    </div>
                @endforeach
            @else
                <div class="detail-item">
                    <div class="detail-label">E-mail</div>
                    <div class="detail-value">usuario@exemplo.com</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Cadastro</div>
                    <div class="detail-value">{{ now()->format('d/m/Y') }}</div>
                </div>
            @endisset
        </div>
        
        <form method="POST" >
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Sair
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Controle do modal de perfil
    document.addEventListener('DOMContentLoaded', function() {
        const profileBtn = document.getElementById('profileBtn');
        const closeProfileBtn = document.getElementById('closeProfileBtn');
        const profileModal = document.getElementById('profileModal');
        
        if (profileBtn && profileModal) {
            profileBtn.addEventListener('click', () => {
                profileModal.classList.add('open');
            });
        }
        
        if (closeProfileBtn) {
            closeProfileBtn.addEventListener('click', () => {
                profileModal.classList.remove('open');
            });
        }
    });
</script>
@endpush