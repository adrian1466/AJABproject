@extends('layouts.app')

@section('title', 'Student Dashboard | AJAB')

@section('content')
    <style>
        .student-board {
            display: grid;
            gap: 18px;
        }

        .student-head {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 270px;
            gap: 18px;
            align-items: stretch;
            padding: clamp(24px, 4vw, 38px);
            border-radius: 8px;
            background:
                linear-gradient(105deg, rgba(24, 32, 47, 0.94), rgba(217, 93, 96, 0.78)),
                url("https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=1500&q=80") center/cover;
            color: #ffffff;
        }

        .student-head h1 {
            margin: 8px 0 10px;
            color: #ffffff !important;
            font-size: clamp(34px, 5vw, 54px);
            line-height: 1;
        }

        .student-head p {
            max-width: 650px;
            margin: 0;
            color: rgba(255, 255, 255, 0.88) !important;
        }

        .student-label,
        .student-section span,
        .student-detail span {
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
        }

        .student-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffdc8a !important;
        }

        .student-pass {
            display: grid;
            align-content: center;
            gap: 10px;
            padding: 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.24);
        }

        .student-pass i {
            color: #ffdc8a;
            font-size: 30px;
        }

        .student-pass strong {
            color: #ffffff;
            font-size: 22px;
        }

        .student-pass span {
            color: rgba(255, 255, 255, 0.86);
            font-weight: 850;
        }

        .student-work {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .student-panel,
        .student-side {
            padding: 22px;
            border: 1px solid #d8e0ea;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 16px 34px rgba(24, 32, 47, 0.09);
        }

        .student-section {
            margin-bottom: 16px;
        }

        .student-section span {
            color: #1b4d89 !important;
        }

        .student-section h2 {
            margin: 5px 0 0;
            color: #18202f !important;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .student-detail {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            min-height: 104px;
            padding: 16px;
            border-radius: 8px;
            background: #f8fbfc;
            border: 1px solid #d8e0ea;
            border-left: 5px solid #d95d60;
        }

        .student-detail:nth-child(2),
        .student-detail:nth-child(4) {
            border-left-color: #1f9d8a;
        }

        .student-detail i,
        .student-side > i,
        .student-empty i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #fff1f1;
            color: #d95d60;
            font-size: 20px;
        }

        .student-detail span {
            display: block;
            color: #647084;
        }

        .student-detail strong {
            display: block;
            margin-top: 4px;
            color: #18202f;
            word-break: break-word;
        }

        .student-side {
            display: grid;
            gap: 12px;
            background: #f8fbfc;
        }

        .student-side h2 {
            margin: 0;
            color: #18202f !important;
        }

        .student-side p {
            margin: 0;
            color: #647084 !important;
        }

        .student-empty {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 18px;
            border-radius: 8px;
            background: #f8fbfc;
            border: 1px solid #d8e0ea;
        }

        .student-empty p {
            margin: 0;
            color: #344054 !important;
            font-weight: 850;
        }

        @media (max-width: 900px) {
            .student-head,
            .student-work,
            .student-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="student-board">
        <header class="student-head">
            <div>
                <span class="student-label"><i class="bi bi-mortarboard-fill"></i>AJAB Student</span>
                <h1>Student Profile</h1>
                <p>View your linked AJAB student information, degree connection, and account status.</p>
            </div>

            <aside class="student-pass">
                <i class="bi bi-person-check-fill"></i>
                <strong>{{ $student ? 'Profile Linked' : 'Profile Pending' }}</strong>
                <span>Student Access</span>
            </aside>
        </header>

        <div class="student-work">
            <section class="student-panel">
                <div class="student-section">
                    <span>Profile</span>
                    <h2>Student Information</h2>
                </div>

                @if($student)
                    <div class="student-grid">
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

            <aside class="student-side">
                <i class="bi bi-patch-check-fill"></i>
                <h2>Account Status</h2>
                <p>{{ $student ? 'Your AJAB student profile is connected and ready.' : 'Please ask an admin to connect your student profile.' }}</p>
            </aside>
        </div>
    </section>
@endsection
