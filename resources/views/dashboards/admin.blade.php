@extends('layouts.app')

@section('title', 'Admin Dashboard | AJAB')

@section('content')
    <style>
        .admin-board {
            display: grid;
            gap: 18px;
        }

        .admin-board * {
            letter-spacing: 0;
        }

        .admin-head {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 18px;
            align-items: stretch;
            padding: clamp(24px, 4vw, 38px);
            border-radius: 8px;
            background:
                linear-gradient(110deg, rgba(24, 32, 47, 0.95), rgba(27, 77, 137, 0.84)),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1500&q=80") center/cover;
            color: #ffffff;
            overflow: hidden;
        }

        .admin-head h1 {
            max-width: 680px;
            margin: 8px 0 10px;
            color: #ffffff !important;
            font-size: clamp(34px, 5vw, 56px);
            line-height: 1;
        }

        .admin-head p {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, 0.88) !important;
        }

        .admin-kicker-new,
        .admin-section-title span,
        .admin-stat span {
            color: #ffdc8a !important;
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
        }

        .admin-kicker-new {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .admin-date {
            display: grid;
            align-content: center;
            gap: 10px;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.24);
        }

        .admin-date i {
            font-size: 30px;
            color: #ffdc8a;
        }

        .admin-date strong {
            color: #ffffff;
            font-size: 21px;
        }

        .admin-date span {
            color: rgba(255, 255, 255, 0.86);
            font-weight: 850;
        }

        .admin-stats-new {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .admin-stat,
        .admin-panel-clean {
            border: 1px solid #d8e0ea;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 16px 34px rgba(24, 32, 47, 0.09);
        }

        .admin-stat {
            display: grid;
            grid-template-columns: 54px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            padding: 18px;
            border-top: 5px solid #1f9d8a;
        }

        .admin-stat:nth-child(2) {
            border-top-color: #1b4d89;
        }

        .admin-stat:nth-child(3) {
            border-top-color: #f2b84b;
        }

        .admin-stat i,
        .admin-link i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #eef6f4;
            color: #1f9d8a;
            font-size: 22px;
        }

        .admin-stat span {
            color: #6b7280 !important;
        }

        .admin-stat strong {
            display: block;
            margin-top: 4px;
            color: #18202f;
            font-size: 34px;
            line-height: 1;
        }

        .admin-work {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .admin-panel-clean {
            padding: 22px;
        }

        .admin-section-title {
            margin-bottom: 16px;
        }

        .admin-section-title span {
            color: #1b4d89 !important;
        }

        .admin-section-title h2 {
            margin: 4px 0 0;
            color: #18202f !important;
        }

        .admin-links {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .admin-link {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            min-height: 118px;
            padding: 16px;
            border-radius: 8px;
            background: #f8fbfc;
            border: 1px solid #d8e0ea;
            color: #18202f;
            text-decoration: none;
        }

        .admin-link:hover {
            border-color: #1f9d8a;
            box-shadow: 0 12px 24px rgba(31, 157, 138, 0.12);
        }

        .admin-link strong {
            color: #18202f;
            font-size: 16px;
        }

        .admin-link span {
            display: block;
            margin-top: 4px;
            color: #647084;
            font-size: 13px;
            line-height: 1.45;
        }

        .admin-checks {
            display: grid;
            gap: 12px;
        }

        .admin-checks div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 12px;
            border-radius: 8px;
            background: #eef6f4;
            color: #28504b;
            font-weight: 850;
            line-height: 1.45;
        }

        .admin-checks i {
            color: #1f9d8a;
            margin-top: 2px;
        }

        @media (max-width: 900px) {
            .admin-head,
            .admin-stats-new,
            .admin-work,
            .admin-links {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="admin-board">
        <header class="admin-head">
            <div>
                <span class="admin-kicker-new"><i class="bi bi-shield-lock-fill"></i>AJAB Admin</span>
                <h1>Control Center</h1>
                <p>Manage accounts, student records, teacher access, and degree data from a cleaner AJAB workspace.</p>
            </div>

            <aside class="admin-date">
                <i class="bi bi-calendar2-check-fill"></i>
                <strong>Administrator</strong>
                <span>{{ now()->format('M d, Y') }}</span>
            </aside>
        </header>

        <section class="admin-stats-new">
            <div class="admin-stat">
                <i class="bi bi-mortarboard-fill"></i>
                <div><span>Students</span><strong>{{ $studentCount }}</strong></div>
            </div>
            <div class="admin-stat">
                <i class="bi bi-person-video3"></i>
                <div><span>Teachers</span><strong>{{ $teacherCount }}</strong></div>
            </div>
            <div class="admin-stat">
                <i class="bi bi-people-fill"></i>
                <div><span>Total Users</span><strong>{{ $studentCount + $teacherCount }}</strong></div>
            </div>
        </section>

        <div class="admin-work">
            <section class="admin-panel-clean">
                <div class="admin-section-title">
                    <span>Actions</span>
                    <h2>AJAB Management</h2>
                </div>

                <div class="admin-links">
                    <a class="admin-link" href="/students/create">
                        <i class="bi bi-person-plus-fill"></i>
                        <div><strong>Add Student</strong><span>Create a new student record and login access.</span></div>
                    </a>
                    <a class="admin-link" href="{{ route('teachers.create') }}">
                        <i class="bi bi-person-fill-add"></i>
                        <div><strong>Add Teacher</strong><span>Create a teacher account for AJAB access.</span></div>
                    </a>
                    <a class="admin-link" href="/students">
                        <i class="bi bi-table"></i>
                        <div><strong>Student List</strong><span>Review, edit, and manage student profiles.</span></div>
                    </a>
                    <a class="admin-link" href="{{ route('teachers.index') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <div><strong>Teacher List</strong><span>View all teacher accounts in the portal.</span></div>
                    </a>
                </div>
            </section>

            <aside class="admin-panel-clean">
                <div class="admin-section-title">
                    <span>Status</span>
                    <h2>System Checks</h2>
                </div>

                <div class="admin-checks">
                    <div><i class="bi bi-check-circle-fill"></i>Admin routes are protected by role access.</div>
                    <div><i class="bi bi-check-circle-fill"></i>Student list and AJAX records are available.</div>
                    <div><i class="bi bi-check-circle-fill"></i>Teacher and student dashboards are ready.</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
