<x-guest-layout>
    <x-slot name="title">Sign In — SmartHire AI</x-slot>

    <div class="sh-auth-card">

        {{-- Header --}}
        <div class="sh-auth-header">
            <a href="{{ route('home') }}" class="sh-auth-header__logo">
                <svg width="28" height="28" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-auth-header__brand">SmartHire</span>
            </a>
            <h1 class="sh-auth-header__title">Welcome back</h1>
            <p class="sh-auth-header__subtitle">Sign in to your SmartHire account.</p>
        </div>

        {{-- Session status --}}
        @if (session('status'))
            <div class="sh-alert sh-alert--success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="login-form">
            @csrf

            {{-- Email --}}
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

            {{-- Password --}}
            <div class="sh-form-group">
                <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom:6px;">
                    <label for="password" class="sh-form-label" style="margin-bottom:0;">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="sh-caption sh-text-primary" style="text-decoration:none; font-weight:400;">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password"
                    class="sh-form-input {{ $errors->has('password') ? 'sh-form-input--error' : '' }}"
                    placeholder="Your password"
                    required autocomplete="current-password">
                @error('password')
                    <span class="sh-form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="sh-form-group">
                <label class="sh-checkbox-label" for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember" class="sh-checkbox">
                    Keep me signed in
                </label>
            </div>

            {{-- Submit --}}
            <div class="sh-form-actions">
                <button type="submit" class="sh-btn-auth-submit" id="login-submit">
                    Sign In
                </button>
            </div>

        </form>

        {{-- Footer link --}}
        <p class="sh-auth-footer-link">
            Don't have an account? <a href="{{ route('register') }}">Create one free</a>
        </p>

    </div>
</x-guest-layout>
