<div class="sidebar-header">
    <h4>@yield('header-title', 'App Name')</h4>
    <button class="profile-btn" id="profileBtn">
        <img src="{{ auth()->user()->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg' }}" alt="Profile" class="profile-img">
        <i class="fas fa-chevron-down"></i>
    </button>
</div>

@push('styles')
<style>
    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-dark);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .profile-btn {
        background: none;
        border: none;
        color: var(--text-dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--primary-color);
    }
</style>
@endpush