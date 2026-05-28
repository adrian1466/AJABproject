@extends('layouts.app')

@section('title', 'Teacher Dashboard | BDC')

@section('content')
    <style>
        .teacher-board {
            display: grid;
            gap: 18px;
        }

        .teacher-head {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 270px;
            gap: 18px;
            align-items: stretch;
            padding: clamp(24px, 4vw, 38px);
            border-radius: 8px;
            background:
                linear-gradient(105deg, rgba(16, 58, 83, 0.94), rgba(31, 157, 138, 0.82)),
                url("https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1500&q=80") center/cover;
            color: #ffffff;
        }

        .teacher-head h1 {
            margin: 8px 0 10px;
            color: #ffffff !important;
            font-size: clamp(34px, 5vw, 54px);
            line-height: 1;
        }

        .teacher-head p {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, 0.88) !important;
        }

        .teacher-label,
        .teacher-section span,
        .teacher-card span {
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
        }

        .teacher-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffdc8a !important;
        }

        .teacher-pass {
            display: grid;
            align-content: center;
            gap: 10px;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.24);
        }

        .teacher-pass i {
            color: #ffdc8a;
            font-size: 30px;
        }

        .teacher-pass strong {
            color: #ffffff;
            font-size: 22px;
        }

        .teacher-pass span {
            color: rgba(255, 255, 255, 0.86);
            font-weight: 850;
        }

        .teacher-work {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .teacher-panel,
        .teacher-side {
            padding: 22px;
            border: 1px solid #d8e0ea;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 16px 34px rgba(24, 32, 47, 0.09);
        }

        .teacher-section {
            margin-bottom: 16px;
        }

        .teacher-section span {
            color: #1b4d89 !important;
        }

        .teacher-section h2 {
            margin: 5px 0 0;
            color: #18202f !important;
        }

        .teacher-panel p,
        .teacher-side p {
            color: #647084 !important;
        }

        .teacher-cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .teacher-card {
            display: grid;
            gap: 9px;
            min-height: 136px;
            padding: 16px;
            border-radius: 8px;
            background: #f8fbfc;
            border: 1px solid #d8e0ea;
            border-top: 5px solid #1b4d89;
        }

        .teacher-card:nth-child(2) {
            border-top-color: #1f9d8a;
        }

        .teacher-card:nth-child(3) {
            border-top-color: #f2b84b;
        }

        .teacher-card i,
        .teacher-side > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #eef6f4;
            color: #1f9d8a;
            font-size: 20px;
        }

        .teacher-card span {
            color: #647084;
        }

        .teacher-card strong {
            color: #18202f;
            font-size: 17px;
        }

        .teacher-side {
            display: grid;
            gap: 12px;
            background: #f8fbfc;
        }

        .teacher-side h2 {
            margin: 0;
            color: #18202f !important;
        }

        .teacher-side p {
            margin: 0;
        }

        @media (max-width: 900px) {
            .teacher-head,
            .teacher-work,
            .teacher-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="teacher-board">
        <header class="teacher-head">
            <div>
                <span class="teacher-label"><i class="bi bi-person-video3"></i>BDC Teacher</span>
                <h1>Classroom Workspace</h1>
                <p>Your teacher session is active and connected to the protected BDC portal.</p>
            </div>

            <aside class="teacher-pass">
                <i class="bi bi-person-badge-fill"></i>
                <strong>Teacher</strong>
                <span>Session Active</span>
            </aside>
        </header>

        <div class="teacher-work">
            <section class="teacher-panel">
                <div class="teacher-section">
                    <span>Overview</span>
                    <h2>Teacher Status</h2>
                </div>

                <p>This page confirms your teacher access. Admin and student pages remain separated by session and role middleware.</p>

                <div class="teacher-cards">
                    <div class="teacher-card">
                        <i class="bi bi-key-fill"></i>
                        <span>Access Level</span>
                        <strong>Teacher</strong>
                    </div>
                    <div class="teacher-card">
                        <i class="bi bi-wifi"></i>
                        <span>Session</span>
                        <strong>Active</strong>
                    </div>
                    <div class="teacher-card">
                        <i class="bi bi-lock-fill"></i>
                        <span>Protection</span>
                        <strong>Enabled</strong>
                    </div>
                </div>
            </section>

            <aside class="teacher-side">
                <i class="bi bi-check2-circle"></i>
                <h2>Ready</h2>
                <p>Your BDC teacher account is verified for protected teacher pages.</p>
            </aside>
        </div>
    </section>
@endsection
