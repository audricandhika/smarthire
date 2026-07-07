<x-guest-layout>
    <x-slot name="title">Verify Your Email — SmartHire AI</x-slot>

    <div class="sh-auth-card sh-verify-card">

        <div class="sh-auth-header">
            <a href="{{ route('home') }}" class="sh-auth-header__logo">
                <svg width="28" height="28" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-auth-header__brand">SmartHire</span>
            </a>

            <div class="sh-verify-icon" aria-hidden="true">
                <div class="sh-verify-envelope">
                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                        <circle cx="22" cy="22" r="22" fill="#eef5ff"/>
                        <path d="M11 17a2 2 0 0 1 2-2h18a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H13a2 2 0 0 1-2-2V17z" stroke="#0066cc" stroke-width="1.6"/>
                        <path d="M11 17l11 8 11-8" stroke="#0066cc" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="sh-verify-envelope__pulse"></div>
                </div>
            </div>

            <h1 class="sh-auth-header__title">Check your email</h1>
            <p class="sh-auth-header__subtitle">
                We sent an activation link to<br>
                <strong style="color: var(--color-ink); font-weight: 600;">{{ auth()->user()->email }}</strong>
            </p>
        </div>

        @if (session('status') === 'verification-link-sent')
            <div class="sh-alert sh-alert--success" role="status">
                ✓ A new activation link has been sent to your email.
            </div>
        @endif

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
                <p class="sh-verify-step__text">You'll be signed in to your dashboard</p>
            </div>
        </div>

        <div class="sh-resend-section" style="margin-top: 28px;">

            <div class="sh-cooldown-ring" id="cooldown-ring" aria-hidden="true">
                <svg class="sh-ring-svg" width="72" height="72" viewBox="0 0 72 72">
                    <circle
                        cx="36" cy="36" r="30"
                        fill="none"
                        stroke="#e0e0e0"
                        stroke-width="3"
                    />
                    <circle
                        id="ring-progress"
                        cx="36" cy="36" r="30"
                        fill="none"
                        stroke="#0066cc"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-dasharray="188.5"
                        stroke-dashoffset="0"
                        transform="rotate(-90 36 36)"
                    />
                </svg>
                <div class="sh-ring-label">
                    <span id="ring-seconds">60</span>
                    <span class="sh-ring-unit">sec</span>
                </div>
            </div>

            <form method="POST" action="{{ route('verification.send') }}" id="resend-form">
                @csrf
                <button
                    type="submit"
                    class="sh-btn-auth-submit sh-btn-resend"
                    id="resend-btn"
                    aria-live="polite"
                    aria-label="Resend activation email">
                    <span class="sh-resend-icon" aria-hidden="true">
                        <svg id="resend-icon-send" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M14 2L2 6.5l5 1.5m7-6L9.5 14l-2-5M2 6.5l12-4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span id="resend-label">Resend Activation Email</span>
                </button>
            </form>

            <p class="sh-cooldown-hint" id="cooldown-hint">
                Email sent! You can resend again after the timer ends.
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 10px;">
            @csrf
            <button type="submit" class="sh-verify-logout-btn" id="logout-btn">
                Sign out &amp; use a different account
            </button>
        </form>

        <p class="sh-verify-hint">
            Didn't receive it? Check your spam folder.
        </p>

    </div>

    @push('scripts')
    <script>
    (function () {
        const COOLDOWN    = 60;
        const STORAGE_KEY = 'sh_resend_ts';
        const CIRCUMFERENCE = 188.5;

        const btn         = document.getElementById('resend-btn');
        const label       = document.getElementById('resend-label');
        const form        = document.getElementById('resend-form');
        const ring        = document.getElementById('cooldown-ring');
        const ringProg    = document.getElementById('ring-progress');
        const ringSeconds = document.getElementById('ring-seconds');
        const hint        = document.getElementById('cooldown-hint');
        const sendIcon    = document.getElementById('resend-icon-send');

        let intervalId = null;

        function setRingProgress(secondsLeft) {
            const fraction   = secondsLeft / COOLDOWN;
            const dashOffset = CIRCUMFERENCE * (1 - fraction);
            ringProg.style.strokeDashoffset = dashOffset;
            ringSeconds.textContent = secondsLeft;
        }

        function enterCooldown(secondsLeft) {
            btn.disabled = true;
            btn.classList.add('sh-btn-resend--cooling');
            ring.classList.add('sh-cooldown-ring--visible');
            hint.classList.add('sh-cooldown-hint--visible');
            sendIcon.style.display = 'none';
            label.textContent = 'Email Sent';
            setRingProgress(secondsLeft);
        }

        function exitCooldown() {
            btn.disabled = false;
            btn.classList.remove('sh-btn-resend--cooling');
            ring.classList.remove('sh-cooldown-ring--visible');
            hint.classList.remove('sh-cooldown-hint--visible');
            sendIcon.style.display = '';
            label.textContent = 'Resend Activation Email';
            setRingProgress(COOLDOWN);
            localStorage.removeItem(STORAGE_KEY);
        }

        function startCountdown(secondsLeft) {
            clearInterval(intervalId);
            enterCooldown(secondsLeft);

            intervalId = setInterval(function () {
                secondsLeft--;
                if (secondsLeft <= 0) {
                    clearInterval(intervalId);
                    exitCooldown();
                } else {
                    setRingProgress(secondsLeft);
                }
            }, 1000);
        }

        const savedTs = localStorage.getItem(STORAGE_KEY);
        if (savedTs) {
            const elapsed   = Math.floor((Date.now() - parseInt(savedTs, 10)) / 1000);
            const remaining = COOLDOWN - elapsed;
            if (remaining > 0) {
                startCountdown(remaining);
            } else {
                localStorage.removeItem(STORAGE_KEY);
            }
        }

        @if(session('status') === 'verification-link-sent')
            localStorage.setItem(STORAGE_KEY, Date.now().toString());
            startCountdown(COOLDOWN);
        @endif

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
    .sh-verify-envelope {
        position: relative;
        display: inline-block;
    }
    .sh-verify-envelope__pulse {
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        border: 2px solid rgba(0, 102, 204, 0.25);
        animation: sh-pulse 2s ease-out infinite;
    }
    @keyframes sh-pulse {
        0%   { transform: scale(0.9); opacity: 1; }
        70%  { transform: scale(1.2); opacity: 0; }
        100% { transform: scale(1.2); opacity: 0; }
    }
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
        width: 24px; height: 24px;
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
    .sh-resend-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }
    .sh-resend-section form { width: 100%; }

    .sh-btn-resend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background 0.3s ease, transform 0.1s ease, opacity 0.3s ease;
    }
    .sh-btn-resend--cooling {
        background: var(--color-canvas-parchment) !important;
        color: var(--color-ink-muted-48) !important;
        border: 1.5px solid var(--color-hairline) !important;
        cursor: not-allowed;
    }
    .sh-btn-resend--cooling:active { transform: none !important; }

    .sh-cooldown-ring {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0;
        opacity: 0;
        transform: scale(0.7);
        max-height: 0;
        overflow: hidden;
        pointer-events: none;
        transition:
            opacity 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
            transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
            max-height 0.4s ease;
    }
    .sh-cooldown-ring--visible {
        opacity: 1;
        transform: scale(1);
        max-height: 120px;
    }
    .sh-ring-svg {
        display: block;
    }
    #ring-progress {
        transition: stroke-dashoffset 0.9s linear;
    }
    .sh-ring-label {
        position: absolute;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
        top: 0;
        left: 0;
    }
    .sh-cooldown-ring {
        position: relative;
    }
    .sh-ring-svg { display: block; }
    #ring-seconds {
        font-size: 22px;
        font-weight: 600;
        color: var(--color-primary);
        line-height: 1;
        letter-spacing: -0.5px;
    }
    .sh-ring-unit {
        font-size: 10px;
        font-weight: 400;
        color: var(--color-ink-muted-48);
        letter-spacing: 0;
        margin-top: 1px;
    }

    .sh-cooldown-hint {
        font-size: 12px;
        color: var(--color-ink-muted-48);
        letter-spacing: -0.08px;
        text-align: center;
        line-height: 1.5;
        opacity: 0;
        transform: translateY(-4px);
        max-height: 0;
        overflow: hidden;
        transition:
            opacity 0.3s ease 0.15s,
            transform 0.3s ease 0.15s,
            max-height 0.3s ease;
        margin: 0;
    }
    .sh-cooldown-hint--visible {
        opacity: 1;
        transform: translateY(0);
        max-height: 40px;
    }
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

    .sh-verify-hint {
        text-align: center;
        font-size: 12px;
        color: var(--color-ink-muted-48);
        letter-spacing: -0.12px;
        margin-top: 16px;
        line-height: 1.5;
    }
    </style>
</x-guest-layout>
