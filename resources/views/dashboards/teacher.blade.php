@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
    <style>
        .teacher-dashboard {
            display: grid;
            gap: 18px;
        }

        .teacher-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 260px;
            gap: 18px;
            align-items: stretch;
            padding: 28px;
            border-radius: 18px;
            background:
                linear-gradient(135deg, rgba(3, 15, 36, 0.98), rgba(11, 42, 91, 0.95)),
                radial-gradient(circle at top right, rgba(56, 189, 248, 0.32), transparent 34%);
            color: #ffffff;
            border: 1px solid rgba(147, 197, 253, 0.22);
            box-shadow: 0 22px 54px rgba(2, 8, 23, 0.26);
        }

        .teacher-hero h1,
        .teacher-hero p {
            color: #ffffff;
        }

        .teacher-hero h1 {
            margin: 8px 0 10px;
            font-size: 38px;
        }

        .teacher-hero p {
            max-width: 650px;
            margin: 0;
            color: #bfdbfe;
        }

        .teacher-eyebrow,
        .teacher-panel-heading span {
            color: #38bdf8;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .teacher-badge {
            display: grid;
            align-content: center;
            gap: 8px;
            padding: 18px;
            border-radius: 14px;
            background: rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(147, 197, 253, 0.22);
        }

        .teacher-badge i {
            color: #38bdf8;
            font-size: 30px;
        }

        .teacher-badge strong {
            color: #ffffff;
            font-size: 20px;
        }

        .teacher-badge span {
            color: #bfdbfe;
            font-weight: 800;
        }

        .teacher-main-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 16px;
            align-items: start;
        }

        .teacher-panel,
        .teacher-ready-panel {
            border: 1px solid #c7d7ee;
            border-radius: 16px;
            background: linear-gradient(180deg, #ffffff 0%, #f3f8ff 100%);
            box-shadow: 0 14px 34px rgba(11, 42, 91, 0.10);
            padding: 22px;
        }

        .teacher-panel-heading {
            margin-bottom: 16px;
        }

        .teacher-panel-heading span {
            color: #1d4ed8;
        }

        .teacher-panel-heading h2 {
            margin: 5px 0 0;
            color: #06142d;
            font-size: 22px;
        }

        .teacher-panel p {
            margin-top: 0;
            color: #52657d;
        }

        .teacher-status-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .teacher-status {
            display: grid;
            gap: 8px;
            padding: 16px;
            border-radius: 14px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
        }

        .teacher-status i,
        .teacher-ready-panel > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #dbeafe;
            color: #0b2a5b;
            font-size: 20px;
        }

        .teacher-status span {
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .teacher-status strong {
            color: #06142d;
            font-size: 17px;
        }

        .teacher-ready-panel {
            display: grid;
            gap: 12px;
            background: #eef6ff;
        }

        .teacher-ready-panel h2 {
            margin: 0;
            color: #06142d;
        }

        .teacher-ready-panel p {
            margin: 0;
            color: #52657d;
        }

        @media (max-width: 900px) {
            .teacher-hero,
            .teacher-main-grid,
            .teacher-status-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="teacher-dashboard">
        <header class="teacher-hero">
            <div>
                <span class="teacher-eyebrow"><i class="bi bi-person-video3"></i> Teacher Workspace</span>
                <h1>Teaching Dashboard</h1>
                <p>Your teacher session is active and protected by role-based access.</p>
            </div>

            <aside class="teacher-badge">
                <i class="bi bi-person-badge-fill"></i>
                <strong>Teacher</strong>
                <span>Session Active</span>
            </aside>
        </header>

        <div class="teacher-main-grid">
            <section class="teacher-panel">
                <div class="teacher-panel-heading">
                    <span>Account Overview</span>
                    <h2>Teacher Status</h2>
                </div>

                <p>You are viewing the teacher dashboard. Admin and student pages remain protected by session and role middleware.</p>

                <div class="teacher-status-grid">
                    <div class="teacher-status">
                        <i class="bi bi-key-fill"></i>
                        <span>Access Level</span>
                        <strong>Teacher</strong>
                    </div>
                    <div class="teacher-status">
                        <i class="bi bi-wifi"></i>
                        <span>Session</span>
                        <strong>Active</strong>
                    </div>
                    <div class="teacher-status">
                        <i class="bi bi-lock-fill"></i>
                        <span>Protection</span>
                        <strong>Enabled</strong>
                    </div>
                </div>
            </section>

            <aside class="teacher-ready-panel">
                <i class="bi bi-check2-circle"></i>
                <h2>Ready</h2>
                <p>Your teacher account is verified and available for protected teacher pages.</p>
            </aside>
        </div>
    </section>
@endsection
