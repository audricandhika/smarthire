<x-guest-layout>
    <x-slot name="title">Reset Password — SmartHire AI</x-slot>

    <div class="sh-auth-card">

        <div class="sh-auth-header">
            <a href="{{ route('home') }}" class="sh-auth-header__logo">
                <svg width="28" height="28" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-auth-header__brand">SmartHire</span>
            </a>
            <h1 class="sh-auth-header__title">Reset your password</h1>
            <p class="sh-auth-header__subtitle">
                Enter your email and we'll send you a reset link.
            </p>
        </div>

        @if (session('status'))
            <div class="sh-alert sh-alert--success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="sh-form-group">
                <label for="email" class="sh-form-label">Email Address</label>
                <input id="email" type="email" name="email"
                    class="sh-form-input {{ $errors->has('email') ? 'sh-form-input--error' : '' }}"
                    value="{{ old('email') }}"
                    placeholder="budi@example.com"
                    required autofocus autocomplete="username">
                @error('email')
                    <span class="sh-form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="sh-form-actions">
                <button type="submit" class="sh-btn-auth-submit" id="forgot-submit">
                    Send Reset Link
                </button>
            </div>
        </form>

        <p class="sh-auth-footer-link">
            Remember your password? <a href="{{ route('login') }}">Sign in</a>
        </p>

    </div>
</x-guest-layout>
