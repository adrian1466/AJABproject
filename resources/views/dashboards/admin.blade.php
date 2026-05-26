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
            background: #0f1f3a;
            color: #ffffff;
            box-shadow: 0 20px 46px rgba(15, 31, 58, 0.20);
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
            color: #d8e4f6;
        }

        .dash-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #93c5fd;
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
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.16);
        }

        .admin-date-card i {
            font-size: 28px;
            color: #93c5fd;
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
            border: 1px solid #d8e0ea;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(23, 32, 51, 0.08);
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
            background: #e8f1ff;
            color: #2563eb;
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
            color: #172033;
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
            color: #2563eb;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .panel-heading h2 {
            margin: 5px 0 0;
            color: #172033;
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
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #172033;
            text-decoration: none;
        }

        .admin-action:hover {
            border-color: #93c5fd;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.12);
        }

        .admin-action strong {
            color: #172033;
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
            background: #f8fafc;
            color: #334155;
            font-weight: 800;
            line-height: 1.4;
        }

        .system-list i {
            color: #16a34a;
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