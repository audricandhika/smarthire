<x-guest-layout>
    <x-slot name="title">Verify Your Email — SmartHire AI</x-slot>

    <div class="sh-auth-card sh-verify-card">

        {{-- Header --}}
        <div class="sh-auth-header">
            <a href="{{ route('home') }}" class="sh-auth-header__logo">
                <svg width="28" height="28" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-auth-header__brand">SmartHire</span>
            </a>

            {{-- Email icon --}}
            <div class="sh-verify-icon" aria-hidden="true">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <circle cx="20" cy="20" r="20" fill="#eef5ff"/>
                    <path d="M10 15a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H12a2 2 0 0 1-2-2V15z" stroke="#0066cc" stroke-width="1.6"/>
                    <path d="M10 15l10 7 10-7" stroke="#0066cc" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1 class="sh-auth-header__title">Check your email</h1>
            <p class="sh-auth-header__subtitle">
                We sent an activation link to<br>
                <strong style="color: var(--color-ink); font-weight: 600;">{{ auth()->user()->email }}</strong>
            </p>
        </div>

        {{-- Success alert when resend clicked --}}
        @if (session('status') === 'verification-link-sent')
            <div class="sh-alert sh-alert--success" role="alert">
                ✓ A new activation link has been sent to your email.
            </div>
        @endif

        {{-- Instructions --}}
        <div class="sh-verify-steps">
            <div class="sh-verify-step">
                <span class="sh-verify-step__num">1</span>
                <p class="sh-verify-step__text">Open the email from <strong>SmartHire AI</strong></p>
            </div>
            <div class="sh-verify-step">
                <span class="sh-verify-step__num">2</span>
                <p class="sh-verify-step__text">Click the <strong>Activate Account</strong> button</p>
            </div>
            <div class="sh-verify-step">
                <span class="sh-verify-step__num">3</span>
                <p class="sh-verify-step__text">You'll be redirected to your dashboard</p>
            </div>
        </div>

        {{-- Resend form with countdown --}}
        <div class="sh-form-actions" style="margin-top: 28px;">
            <form method="POST" action="{{ route('verification.send') }}" id="resend-form">
                @csrf
                <button type="submit"
                    class="sh-btn-auth-submit sh-btn-resend"
                    id="resend-btn"
                    aria-live="polite">
                    <span id="resend-label">Resend Activation Email</span>
                </button>
            </form>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 12px;">
            @csrf
            <button type="submit" class="sh-verify-logout-btn" id="logout-btn">
                Sign out and use a different account
            </button>
        </form>

        <p class="sh-verify-hint">
            Didn't receive the email? Check your spam folder, or click resend above.
        </p>

    </div>

    @push('scripts')
    <script>
    (function () {
        const COOLDOWN = 60; 
        const STORAGE_KEY = 'sh_resend_ts';

        const btn    = document.getElementById('resend-btn');
        const label  = document.getElementById('resend-label');
        const form   = document.getElementById('resend-form');

        let timer = null;

        function startCountdown(secondsLeft) {
            btn.disabled = true;
            btn.classList.add('sh-btn-resend--disabled');

            function tick() {
                if (secondsLeft <= 0) {
                    clearInterval(timer);
                    btn.disabled = false;
                    btn.classList.remove('sh-btn-resend--disabled');
                    label.textContent = 'Resend Activation Email';
                    localStorage.removeItem(STORAGE_KEY);
                    return;
                }
                label.textContent = `Resend in ${secondsLeft}s`;
                secondsLeft--;
            }

            tick(); 
            timer = setInterval(tick, 1000);
        }

        // Check if there's a saved timestamp from a previous resend
        const savedTs = localStorage.getItem(STORAGE_KEY);
        if (savedTs) {
            const elapsed = Math.floor((Date.now() - parseInt(savedTs, 10)) / 1000);
            const remaining = COOLDOWN - elapsed;
            if (remaining > 0) {
                startCountdown(remaining);
            } else {
                localStorage.removeItem(STORAGE_KEY);
            }
        }

        // Also start countdown if status just came in (page just loaded after resend)
        @if(session('status') === 'verification-link-sent')
            localStorage.setItem(STORAGE_KEY, Date.now().toString());
            startCountdown(COOLDOWN);
        @endif

        // On form submit: save timestamp, then submit
        form.addEventListener('submit', function () {
            localStorage.setItem(STORAGE_KEY, Date.now().toString());
        });
    })();
    </script>
    @endpush

    <style>
    .sh-verify-card { max-width: 460px; }

    .sh-verify-icon {
        display: flex;
        justify-content: center;
        margin-bottom: 16px;
    }

    /* Steps */
    .sh-verify-steps {
        display: flex;
        flex-direction: column;
        gap: 12px;
        background: var(--color-canvas-parchment);
        border-radius: var(--rounded-md);
        padding: 16px 18px;
        margin-top: 4px;
    }
    .sh-verify-step {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .sh-verify-step__num {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--color-primary);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .sh-verify-step__text {
        font-size: 14px;
        color: var(--color-ink-muted-80);
        letter-spacing: -0.12px;
        line-height: 1.4;
    }

    /* Resend button disabled state */
    .sh-btn-resend--disabled {
        background: var(--color-ink-muted-48) !important;
        cursor: not-allowed;
        opacity: 1 !important;
    }

    /* Logout text button */
    .sh-verify-logout-btn {
        display: block;
        width: 100%;
        background: none;
        border: none;
        font-family: var(--font-family);
        font-size: 14px;
        color: var(--color-ink-muted-48);
        letter-spacing: -0.12px;
        text-align: center;
        cursor: pointer;
        padding: 8px 0;
        transition: color 0.15s;
    }
    .sh-verify-logout-btn:hover { color: var(--color-ink); }

    /* Hint text */
    .sh-verify-hint {
        text-align: center;
        font-size: 12px;
        color: var(--color-ink-muted-48);
        letter-spacing: -0.12px;
        margin-top: 20px;
        line-height: 1.5;
    }
    </style>
</x-guest-layout>
