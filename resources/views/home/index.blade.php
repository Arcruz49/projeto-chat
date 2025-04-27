@extends('layout.layout')

@section('title', 'Dashboard')

@section('main-content')
    <div class="welcome-message">
        {{-- <h2>Bem-vindo, {{ auth()->user()->name }}!</h2> --}}
        <p>Selecione uma conversa ou comece uma nova.</p>
    </div>
@endsection

@push('components')
    @include('components.navbar')
    @include('components.profile-modal', [
        'user' => [
            'name' => 'auth()->user()->name',
            'avatar' => 'auth()->user()->avatar',
            'status' => 'Online',
            'details' => [
                ['label' => 'E-mail', 'value' => 'auth()->user()->email'],
                ['label' => 'Membro desde', 'value' => 'auth()->user()->created_at->format(d/m/Y)']
            ]
        ]
    ])
@endpush

@push('styles')
<style>
    .welcome-message {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
    }
    
    .welcome-message h2 {
        color: var(--primary-color);
        margin-bottom: 1rem;
    }
    
    .welcome-message p {
        color: #94a3b8;
        font-size: 1.1rem;
    }
</style>
@endpush