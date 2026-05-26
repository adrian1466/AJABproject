@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <style>
        .student-dashboard {
            display: grid;
            gap: 18px;
        }

        .student-hero {
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

        .student-hero h1,
        .student-hero p {
            color: #ffffff;
        }

        .student-hero h1 {
            margin: 8px 0 10px;
            font-size: 38px;
        }

        .student-hero p {
            max-width: 650px;
            margin: 0;
            color: #bfdbfe;
        }

        .student-eyebrow,
        .student-panel-heading span {
            color: #38bdf8;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .student-status-card {
            display: grid;
            align-content: center;
            gap: 8px;
            padding: 18px;
            border-radius: 14px;
            background: rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(147, 197, 253, 0.22);
        }

        .student-status-card i {
            font-size: 30px;
            color: #38bdf8;
        }

        .student-status-card strong {
            color: #ffffff;
            font-size: 20px;
        }

        .student-status-card span {
            color: #bfdbfe;
            font-weight: 800;
        }

        .student-main-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 16px;
            align-items: start;
        }

        .student-panel,
        .student-note-panel {
            border: 1px solid #c7d7ee;
            border-radius: 16px;
            background: linear-gradient(180deg, #ffffff 0%, #f3f8ff 100%);
            box-shadow: 0 14px 34px rgba(11, 42, 91, 0.10);
            padding: 22px;
        }

        .student-panel-heading {
            margin-bottom: 16px;
        }

        .student-panel-heading span {
            color: #1d4ed8;
        }

        .student-panel-heading h2 {
            margin: 5px 0 0;
            color: #06142d;
            font-size: 22px;
        }

        .student-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .student-detail {
            display: grid;
            grid-template-columns: 44px minmax(0, 1fr);
            gap: 12px;
            align-items: center;
            min-height: 98px;
            padding: 16px;
            border-radius: 14px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
        }

        .student-detail i,
        .student-note-panel > i,
        .student-empty i {
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

        .student-detail span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .student-detail strong {
            display: block;
            margin-top: 4px;
            color: #06142d;
            word-break: break-word;
        }

        .student-note-panel {
            display: grid;
            gap: 12px;
            background: #eef6ff;
        }

        .student-note-panel h2 {
            margin: 0;
            color: #06142d;
        }

        .student-note-panel p {
            margin: 0;
            color: #52657d;
        }

        .student-empty {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 18px;
            border-radius: 14px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
        }

        .student-empty p {
            margin: 0;
            color: #334155;
            font-weight: 800;
        }

        @media (max-width: 900px) {
            .student-hero,
            .student-main-grid,
            .student-detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="student-dashboard">
        <header class="student-hero">
            <div>
                <span class="student-eyebrow"><i class="bi bi-mortarboard-fill"></i> Student Portal</span>
                <h1>Academic Profile</h1>
                <p>View your student information, degree connection, and account status in one focused dashboard.</p>
            </div>

            <aside class="student-status-card">
                <i class="bi bi-person-check-fill"></i>
                <strong>{{ $student ? 'Profile Linked' : 'Profile Pending' }}</strong>
                <span>Student Access</span>
            </aside>
        </header>

        <div class="student-main-grid">
            <section class="student-panel">
                <div class="student-panel-heading">
                    <span>Profile Details</span>
                    <h2>Student Information</h2>
                </div>

                @if($student)
                    <div class="student-detail-grid">
                        <div class="student-detail">
                            <i class="bi bi-hash"></i>
                            <div><span>Student ID</span><strong>{{ $student->student_id }}</strong></div>
                        </div>
                        <div class="student-detail">
                            <i class="bi bi-person-fill"></i>
                            <div><span>Name</span><strong>{{ $student->first_name }} {{ $student->last_name }}</strong></div>
                        </div>
                        <div class="student-detail">
                            <i class="bi bi-envelope-fill"></i>
                            <div><span>Email</span><strong>{{ $student->email }}</strong></div>
                        </div>
                        <div class="student-detail">
                            <i class="bi bi-award-fill"></i>
                            <div><span>Degree</span><strong>{{ $student->degree->degree_title ?? 'No Degree' }}</strong></div>
                        </div>
                    </div>
                @else
                    <div class="student-empty">
                        <i class="bi bi-info-circle-fill"></i>
                        <p>No student profile is linked to this account yet.</p>
                    </div>
                @endif
            </section>

            <aside class="student-note-panel">
                <i class="bi bi-patch-check-fill"></i>
                <h2>Account Status</h2>
                <p>{{ $student ? 'Your student profile is connected and ready.' : 'Please ask an admin to connect your student profile.' }}</p>
            </aside>
        </div>
    </section>
@endsection
