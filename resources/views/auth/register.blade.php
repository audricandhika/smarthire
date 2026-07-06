<x-guest-layout>
    <x-slot name="title">Create Account — SmartHire AI</x-slot>

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
            <h1 class="sh-auth-header__title">Create your account</h1>
            <p class="sh-auth-header__subtitle">Join SmartHire AI — free forever.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="register-form">
            @csrf

            {{-- Role Selector --}}
            <p class="sh-form-label" id="role-label">I want to</p>
            <div class="sh-role-selector" role="radiogroup" aria-labelledby="role-label">

                <label class="sh-role-card">
                    <input type="radio" name="role" value="applicant"
                        {{ (old('role', $defaultRole) === 'applicant') ? 'checked' : '' }}
                        id="role-applicant" required>
                    <div class="sh-role-card__body">
                        <div class="sh-role-card__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="sh-role-card__label">Find a Job</span>
                        <span class="sh-role-card__desc">Browse and apply to open positions</span>
                    </div>
                </label>

                <label class="sh-role-card">
                    <input type="radio" name="role" value="recruiter"
                        {{ (old('role', $defaultRole) === 'recruiter') ? 'checked' : '' }}
                        id="role-recruiter" required>
                    <div class="sh-role-card__body">
                        <div class="sh-role-card__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="7" width="18" height="13" rx="2" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M8 7V5a4 4 0 0 1 8 0v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                <path d="M12 12v3M10.5 13.5h3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <span class="sh-role-card__label">Hire Talent</span>
                        <span class="sh-role-card__desc">Post jobs & screen candidates with AI</span>
                    </div>
                </label>

            </div>
            @error('role')
                <span class="sh-form-error" role="alert">{{ $message }}</span>
            @enderror

            {{-- Full Name --}}
            <div class="sh-form-group">
                <label for="name" class="sh-form-label">Full Name</label>
                <input id="name" type="text" name="name"
                    class="sh-form-input {{ $errors->has('name') ? 'sh-form-input--error' : '' }}"
                    value="{{ old('name') }}"
                    placeholder="Budi Santoso"
                    required autofocus autocomplete="name">
                @error('name')
                    <span class="sh-form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="sh-form-group">
                <label for="email" class="sh-form-label">Email Address</label>
                <input id="email" type="email" name="email"
                    class="sh-form-input {{ $errors->has('email') ? 'sh-form-input--error' : '' }}"
                    value="{{ old('email') }}"
                    placeholder="budi@example.com"
                    required autocomplete="username">
                @error('email')
                    <span class="sh-form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="sh-form-group">
                <label for="password" class="sh-form-label">Password</label>
                <input id="password" type="password" name="password"
                    class="sh-form-input {{ $errors->has('password') ? 'sh-form-input--error' : '' }}"
                    placeholder="Min. 8 characters"
                    required autocomplete="new-password">
                @error('password')
                    <span class="sh-form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="sh-form-group">
                <label for="password_confirmation" class="sh-form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="sh-form-input {{ $errors->has('password_confirmation') ? 'sh-form-input--error' : '' }}"
                    placeholder="Re-enter your password"
                    required autocomplete="new-password">
                @error('password_confirmation')
                    <span class="sh-form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="sh-form-actions">
                <button type="submit" class="sh-btn-auth-submit" id="register-submit">
                    Create Account
                </button>
            </div>

        </form>

        {{-- Footer link --}}
        <p class="sh-auth-footer-link">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </p>

    </div>
</x-guest-layout>
