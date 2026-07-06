<x-public-layout>
    <x-slot name="title">SmartHire AI — Smarter Hiring with AI</x-slot>
    <x-slot name="description">SmartHire AI uses Groq-powered AI to screen CVs, score candidates, and surface your best hire in seconds.</x-slot>

    <section class="sh-tile sh-tile--light sh-hero-tile" id="hero" aria-labelledby="hero-headline">
        <div class="sh-tile__inner">

            <p class="sh-tagline sh-text-primary sh-hero-eyebrow">AI-Powered Recruitment</p>
            <div class="sh-spacer-sm"></div>

            <h1 class="sh-hero-display" id="hero-headline">
                The smarter way<br>to hire.
            </h1>
            <div class="sh-spacer-lg"></div>

            <p class="sh-lead sh-text-muted-sub">
                SmartHire AI screens CVs, scores every candidate,<br class="sh-br-desktop">
                and surfaces your best match — in seconds.
            </p>

            <div class="sh-cta-pair">
                <a href="{{ route('register') }}?role=recruiter" class="sh-btn-primary" id="hero-cta-recruiter">
                    Post a Job Free
                </a>
                <a href="{{ route('jobs.index') }}" class="sh-btn-secondary-pill" id="hero-cta-browse">
                    Browse Jobs
                </a>
            </div>

            <div class="sh-hero-visual" aria-hidden="true">
                <div class="sh-hero-card sh-hero-card--main">
                    <div class="sh-hero-card__avatar">AK</div>
                    <div class="sh-hero-card__info">
                        <p class="sh-hero-card__name">Andi Kurniawan</p>
                        <p class="sh-hero-card__role">Full-Stack Developer · 4 yrs exp</p>
                    </div>
                    <div class="sh-hero-card__score sh-hero-card__score--high">92</div>
                </div>
                <div class="sh-hero-card sh-hero-card--secondary">
                    <div class="sh-hero-card__avatar sh-hero-card__avatar--2">SR</div>
                    <div class="sh-hero-card__info">
                        <p class="sh-hero-card__name">Sari Rahmawati</p>
                        <p class="sh-hero-card__role">UI Designer · 2 yrs exp</p>
                    </div>
                    <div class="sh-hero-card__score sh-hero-card__score--mid">74</div>
                </div>
                <div class="sh-hero-badge">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="8" fill="#0066cc"/><path d="M5 8.5l2 2 4-4" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    AI analysis complete · 3 top candidates found
                </div>
            </div>
        </div>
    </section>

    <section class="sh-tile sh-tile--dark" aria-label="Platform statistics">
        <div class="sh-tile__inner sh-tile__inner--wide">
            <div class="sh-stats-grid">
                <div class="sh-stat">
                    <p class="sh-display-lg sh-text-primary-dark">10×</p>
                    <p class="sh-body-text sh-text-muted">Faster candidate screening</p>
                </div>
                <div class="sh-stat">
                    <p class="sh-display-lg sh-text-primary-dark">95%</p>
                    <p class="sh-body-text sh-text-muted">Accuracy on CV matching</p>
                </div>
                <div class="sh-stat">
                    <p class="sh-display-lg sh-text-primary-dark">0</p>
                    <p class="sh-body-text sh-text-muted">Bias in AI scoring</p>
                </div>
            </div>
        </div>
    </section>

    <section class="sh-tile sh-tile--parchment" id="how-it-works" aria-labelledby="how-title">
        <div class="sh-tile__inner">

            <p class="sh-tagline sh-text-primary">Simple. Fast. Smart.</p>
            <div class="sh-spacer-sm"></div>
            <h2 class="sh-display-lg" id="how-title">How SmartHire AI works.</h2>
            <div class="sh-spacer-xxl"></div>

            <div class="sh-steps">
                <div class="sh-step">
                    <div class="sh-step__number">01</div>
                    <h3 class="sh-body-strong sh-step__title">Post Your Job</h3>
                    <p class="sh-body-text sh-text-muted-sub sh-step__desc">
                        Recruiters create a detailed job posting with requirements, responsibilities, and the ideal candidate profile.
                    </p>
                </div>
                <div class="sh-step__connector" aria-hidden="true"></div>
                <div class="sh-step">
                    <div class="sh-step__number">02</div>
                    <h3 class="sh-body-strong sh-step__title">Candidates Apply</h3>
                    <p class="sh-body-text sh-text-muted-sub sh-step__desc">
                        Applicants build their profile, upload their CV, and apply with a cover letter — all in minutes.
                    </p>
                </div>
                <div class="sh-step__connector" aria-hidden="true"></div>
                <div class="sh-step">
                    <div class="sh-step__number">03</div>
                    <h3 class="sh-body-strong sh-step__title">AI Screens & Scores</h3>
                    <p class="sh-body-text sh-text-muted-sub sh-step__desc">
                        Our AI reads every CV, matches it against your job requirements, and assigns a 0–100 score with clear reasoning.
                    </p>
                </div>
                <div class="sh-step__connector" aria-hidden="true"></div>
                <div class="sh-step">
                    <div class="sh-step__number">04</div>
                    <h3 class="sh-body-strong sh-step__title">Hire with Confidence</h3>
                    <p class="sh-body-text sh-text-muted-sub sh-step__desc">
                        Review ranked candidates, read AI-generated summaries, and get tailored interview questions — ready to decide.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="sh-tile sh-tile--dark" id="features" aria-labelledby="features-title">
        <div class="sh-tile__inner sh-tile__inner--wide">

            <p class="sh-tagline" style="color: var(--color-primary-on-dark);">Built for modern hiring</p>
            <div class="sh-spacer-sm"></div>
            <h2 class="sh-display-lg" id="features-title">Everything you need.<br>Nothing you don't.</h2>
            <div class="sh-spacer-xxl"></div>

            <div class="sh-features-grid">

                <div class="sh-feature-card">
                    <div class="sh-feature-card__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 12h6M9 16h4M7 8h10a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M14 8V6a2 2 0 0 0-2-2H8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </div>
                    <h3 class="sh-body-strong sh-feature-card__title">AI CV Screening</h3>
                    <p class="sh-caption sh-feature-card__desc sh-text-muted">
                        Automatically extracts skills, experience, and education from any PDF CV — no manual parsing needed.
                    </p>
                </div>

                <div class="sh-feature-card">
                    <div class="sh-feature-card__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </div>
                    <h3 class="sh-body-strong sh-feature-card__title">0–100 Match Score</h3>
                    <p class="sh-caption sh-feature-card__desc sh-text-muted">
                        Each candidate receives a precise score with AI reasoning — strengths, gaps, and overall recommendation.
                    </p>
                </div>

                <div class="sh-feature-card">
                    <div class="sh-feature-card__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.6"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </div>
                    <h3 class="sh-body-strong sh-feature-card__title">Ranked Candidates</h3>
                    <p class="sh-caption sh-feature-card__desc sh-text-muted">
                        All applicants sorted by AI score. Focus your time on your top candidates, not your inbox.
                    </p>
                </div>

                <div class="sh-feature-card">
                    <div class="sh-feature-card__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h3 class="sh-body-strong sh-feature-card__title">Interview Questions</h3>
                    <p class="sh-caption sh-feature-card__desc sh-text-muted">
                        AI generates tailored interview questions for each candidate based on their profile and your job requirements.
                    </p>
                </div>

                <div class="sh-feature-card">
                    <div class="sh-feature-card__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h3 class="sh-body-strong sh-feature-card__title">Application Tracking</h3>
                    <p class="sh-caption sh-feature-card__desc sh-text-muted">
                        Real-time status updates for applicants: Pending → Review → Interview → Accepted. Full transparency.
                    </p>
                </div>

                <div class="sh-feature-card">
                    <div class="sh-feature-card__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><rect x="2" y="3" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    </div>
                    <h3 class="sh-body-strong sh-feature-card__title">Recruiter Dashboard</h3>
                    <p class="sh-caption sh-feature-card__desc sh-text-muted">
                        Analytics, candidate stats, and pipeline overview — everything at a glance for your hiring team.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="sh-tile sh-tile--parchment" aria-label="Get started">
        <div class="sh-tile__inner sh-tile__inner--wide">
            <div class="sh-dual-cta">

                <div class="sh-dual-cta__card">
                    <p class="sh-tagline sh-text-primary">For Recruiters</p>
                    <h2 class="sh-display-md">Find your best hire,<br>10× faster.</h2>
                    <p class="sh-body-text sh-text-muted-sub">
                        Post jobs, let AI screen applicants, and spend your time only on the candidates that matter.
                    </p>
                    <div class="sh-cta-pair" style="justify-content:flex-start; margin-top:24px;">
                        <a href="{{ route('register') }}?role=recruiter" class="sh-btn-primary" id="cta-recruiter-start">
                            Start Hiring Free
                        </a>
                        <a href="#how-it-works" class="sh-btn-secondary-pill" id="cta-recruiter-learn">
                            Learn more
                        </a>
                    </div>
                </div>

                <div class="sh-dual-cta__divider" aria-hidden="true"></div>

                <div class="sh-dual-cta__card">
                    <p class="sh-tagline sh-text-primary">For Applicants</p>
                    <h2 class="sh-display-md">Stand out with<br>an AI-powered profile.</h2>
                    <p class="sh-body-text sh-text-muted-sub">
                        Upload your CV, apply to jobs, and see how your profile scores against job requirements in real time.
                    </p>
                    <div class="sh-cta-pair" style="justify-content:flex-start; margin-top:24px;">
                        <a href="{{ route('register') }}" class="sh-btn-primary" id="cta-applicant-start">
                            Create Profile Free
                        </a>
                        <a href="{{ route('jobs.index') }}" class="sh-btn-secondary-pill" id="cta-applicant-jobs">
                            Browse Jobs
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="sh-tile sh-tile--dark-2" aria-labelledby="final-cta-title">
        <div class="sh-tile__inner">
            <h2 class="sh-hero-display" id="final-cta-title">
                Hiring, powered<br>by intelligence.
            </h2>
            <div class="sh-spacer-lg"></div>
            <p class="sh-lead-airy sh-text-muted">
                Join companies using SmartHire AI to build<br class="sh-br-desktop">
                better teams, faster.
            </p>
            <div class="sh-cta-pair">
                <a href="{{ route('register') }}" class="sh-btn-primary" id="final-cta-start">
                    Get started free
                </a>
                <a href="{{ route('login') }}" class="sh-btn-secondary-dark" id="final-cta-signin">
                    Sign in
                </a>
            </div>
        </div>
    </section>

</x-public-layout>

<style>
.sh-hero-eyebrow { margin-bottom: 0; }
.sh-text-muted-sub { color: var(--color-ink-muted-80); }
.sh-tile--dark .sh-text-muted-sub,
.sh-tile--dark-2 .sh-text-muted-sub { color: var(--color-body-muted); }

.sh-hero-tile { padding-top: calc(var(--space-section) + 20px); padding-bottom: 0; }

.sh-hero-visual {
  position: relative;
  margin: 48px auto 0;
  max-width: 560px;
  padding-bottom: 48px;
}
.sh-hero-card {
  display: flex;
  align-items: center;
  gap: 14px;
  background: var(--color-canvas);
  border: 1px solid var(--color-hairline);
  border-radius: var(--rounded-lg);
  padding: 16px 20px;
  box-shadow: var(--shadow-product);
}
.sh-hero-card--main { margin-bottom: 12px; }
.sh-hero-card--secondary {
  margin-left: 32px;
  opacity: 0.75;
  transform: scale(0.96);
}
.sh-hero-card__avatar {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: #ddeeff;
  color: var(--color-primary);
  font-size: 14px;
  font-weight: 600;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.sh-hero-card__avatar--2 { background: #e8f0fe; color: #3366cc; }
.sh-hero-card__info { flex: 1; text-align: left; }
.sh-hero-card__name { font-size: 14px; font-weight: 600; color: var(--color-ink); line-height: 1.3; }
.sh-hero-card__role { font-size: 12px; color: var(--color-ink-muted-48); margin-top: 2px; }
.sh-hero-card__score {
  font-size: 20px;
  font-weight: 700;
  border-radius: var(--rounded-sm);
  padding: 6px 10px;
  line-height: 1;
  flex-shrink: 0;
}
.sh-hero-card__score--high { background: #e6f4ea; color: #1a7f37; }
.sh-hero-card__score--mid  { background: #fff3cd; color: #856404; }
.sh-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--color-canvas);
  border: 1px solid var(--color-hairline);
  border-radius: var(--rounded-pill);
  padding: 8px 16px;
  font-size: 12px;
  color: var(--color-ink-muted-80);
  margin-top: 16px;
  box-shadow: 0 1px 6px rgba(0,0,0,0.06);
}

.sh-stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 40px;
}
.sh-stat { text-align: center; }

.sh-steps {
  display: flex;
  align-items: flex-start;
  gap: 0;
  text-align: left;
}
.sh-step {
  flex: 1;
  padding: 0 24px;
}
.sh-step__number {
  font-size: 34px;
  font-weight: 600;
  color: var(--color-primary);
  letter-spacing: -0.374px;
  line-height: 1;
  margin-bottom: 16px;
}
.sh-step__title { margin-bottom: 8px; }
.sh-step__desc { color: var(--color-ink-muted-80); }
.sh-step__connector {
  width: 1px;
  height: 80px;
  background: var(--color-hairline);
  flex-shrink: 0;
  margin-top: 40px;
}

.sh-features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2px;
  background: rgba(255,255,255,0.06);
  border-radius: var(--rounded-lg);
  overflow: hidden;
}
.sh-feature-card {
  background: rgba(255,255,255,0.04);
  padding: 32px 28px;
  text-align: left;
  transition: background 0.2s;
}
.sh-feature-card:hover { background: rgba(255,255,255,0.08); }
.sh-feature-card__icon {
  color: var(--color-primary-on-dark);
  margin-bottom: 16px;
}
.sh-feature-card__title { color: var(--color-body-on-dark); margin-bottom: 8px; }
.sh-feature-card__desc  { color: var(--color-body-muted); }

.sh-dual-cta {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  gap: 48px;
  align-items: center;
  text-align: left;
}
.sh-dual-cta__divider {
  width: 1px;
  height: 240px;
  background: var(--color-hairline);
}
.sh-dual-cta__card p.sh-body-text { margin-top: 12px; color: var(--color-ink-muted-80); }

.sh-br-desktop { display: block; }
@media (max-width: 833px) {
  .sh-stats-grid { grid-template-columns: 1fr; gap: 24px; }
  .sh-steps { flex-direction: column; gap: 32px; }
  .sh-step { padding: 0; }
  .sh-step__connector { display: none; }
  .sh-features-grid { grid-template-columns: 1fr; }
  .sh-dual-cta { grid-template-columns: 1fr; }
  .sh-dual-cta__divider { width: 100%; height: 1px; }
  .sh-br-desktop { display: none; }
  .sh-hero-card--secondary { margin-left: 0; }
}
</style>
