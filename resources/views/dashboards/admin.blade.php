@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .role-dashboard {
            display: grid;
            gap: 18px;
        }

        .role-dashboard * {
            letter-spacing: 0;
        }

        .admin-command-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 260px;
            gap: 18px;
            align-items: stretch;
            padding: 28px;
            border-radius: 18px;
            background:
                linear-gradient(135deg, rgba(3, 15, 36, 0.98), rgba(11, 42, 91, 0.95)),
                radial-gradient(circle at top right, rgba(56, 189, 248, 0.35), transparent 34%);
            color: #ffffff;
            border: 1px solid rgba(147, 197, 253, 0.22);
            box-shadow: 0 22px 54px rgba(2, 8, 23, 0.26);
        }

        .admin-command-hero h1,
        .admin-command-hero p {
            color: #ffffff;
        }

        .admin-command-hero h1 {
            margin: 8px 0 10px;
            font-size: 38px;
        }

        .admin-command-hero p {
            max-width: 680px;
            margin: 0;
            color: #bfdbfe;
        }

        .dash-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #38bdf8;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .admin-date-card {
            display: grid;
            align-content: center;
            gap: 8px;
            padding: 18px;
            border-radius: 14px;
            background: rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(147, 197, 253, 0.22);
        }

        .admin-date-card i {
            font-size: 28px;
            color: #38bdf8;
        }

        .admin-date-card strong {
            color: #ffffff;
            font-size: 20px;
        }

        .admin-date-card span {
            color: #cbd5e1;
            font-weight: 800;
        }

        .admin-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .admin-metric,
        .admin-work-panel,
        .admin-side-panel {
            border: 1px solid #c7d7ee;
            border-radius: 16px;
            background: linear-gradient(180deg, #ffffff 0%, #f3f8ff 100%);
            box-shadow: 0 14px 34px rgba(11, 42, 91, 0.10);
        }

        .admin-metric {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            padding: 18px;
        }

        .admin-metric i,
        .admin-action i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: #dbeafe;
            color: #0b2a5b;
            font-size: 22px;
        }

        .admin-metric span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .admin-metric strong {
            display: block;
            margin-top: 4px;
            color: #06142d;
            font-size: 30px;
            line-height: 1;
        }

        .admin-content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 16px;
            align-items: start;
        }

        .admin-work-panel,
        .admin-side-panel {
            padding: 22px;
        }

        .panel-heading {
            margin-bottom: 16px;
        }

        .panel-heading span {
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .panel-heading h2 {
            margin: 5px 0 0;
            color: #06142d;
            font-size: 22px;
        }

        .admin-action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .admin-action {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            min-height: 112px;
            padding: 16px;
            border-radius: 14px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
            color: #06142d;
            text-decoration: none;
            transition: transform 150ms ease, box-shadow 150ms ease, border-color 150ms ease;
        }

        .admin-action:hover {
            transform: translateY(-2px);
            border-color: #60a5fa;
            box-shadow: 0 16px 28px rgba(29, 78, 216, 0.14);
        }

        .admin-action strong {
            color: #06142d;
            font-size: 16px;
        }

        .admin-action span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.45;
        }

        .system-list {
            display: grid;
            gap: 12px;
        }

        .system-list div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 12px;
            border-radius: 12px;
            background: #eef6ff;
            color: #334155;
            font-weight: 800;
            line-height: 1.4;
        }

        .system-list i {
            color: #1d4ed8;
            margin-top: 2px;
        }

        @media (max-width: 900px) {
            .admin-command-hero,
            .admin-metrics,
            .admin-content-grid,
            .admin-action-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="role-dashboard">
        <header class="admin-command-hero">
            <div>
                <span class="dash-eyebrow"><i class="bi bi-shield-lock"></i>Admin Workspace</span>
                <h1>School Records Dashboard</h1>
                <p>Manage students, teachers, degrees, and role-based access from one clean workspace.</p>
            </div>

            <aside class="admin-date-card">
                <i class="bi bi-calendar2-check"></i>
                <strong>Administrator</strong>
                <span>{{ now()->format('M d, Y') }}</span>
            </aside>
        </header>

        <section class="admin-metrics">
            <div class="admin-metric">
                <i class="bi bi-mortarboard-fill"></i>
                <div><span>Students</span><strong>{{ $studentCount }}</strong></div>
            </div>
            <div class="admin-metric">
                <i class="bi bi-person-video3"></i>
                <div><span>Teachers</span><strong>{{ $teacherCount }}</strong></div>
            </div>
            <div class="admin-metric">
                <i class="bi bi-people-fill"></i>
                <div><span>Total Users</span><strong>{{ $studentCount + $teacherCount }}</strong></div>
            </div>
        </section>

        <div class="admin-content-grid">
            <section class="admin-work-panel">
                <div class="panel-heading">
                    <span>Quick Actions</span>
                    <h2>Manage Records</h2>
                </div>

                <div class="admin-action-grid">
                    <a class="admin-action" href="/students/create">
                        <i class="bi bi-person-plus-fill"></i>
                        <div><strong>Add Student</strong><span>Create student record and login access.</span></div>
                    </a>
                    <a class="admin-action" href="{{ route('teachers.create') }}">
                        <i class="bi bi-person-fill-add"></i>
                        <div><strong>Add Teacher</strong><span>Create a teacher account.</span></div>
                    </a>
                    <a class="admin-action" href="/students">
                        <i class="bi bi-table"></i>
                        <div><strong>Student List</strong><span>Review, update, and manage student data.</span></div>
                    </a>
                    <a class="admin-action" href="{{ route('teachers.index') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <div><strong>Teacher List</strong><span>View all teacher accounts.</span></div>
                    </a>
                </div>
            </section>

            <aside class="admin-side-panel">
                <div class="panel-heading">
                    <span>Status</span>
                    <h2>System Checks</h2>
                </div>

                <div class="system-list">
                    <div><i class="bi bi-check-circle-fill"></i>Admin routes are role protected</div>
                    <div><i class="bi bi-check-circle-fill"></i>Student AJAX list route is active</div>
                    <div><i class="bi bi-check-circle-fill"></i>Teacher and student dashboards are available</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
