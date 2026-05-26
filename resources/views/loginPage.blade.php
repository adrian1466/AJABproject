<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BDC Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 28px;
            display: grid;
            place-items: center;
            background:
                linear-gradient(180deg, rgba(2, 8, 23, 0.24), rgba(2, 8, 23, 0.86)),
                url("https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?auto=format&fit=crop&w=1800&q=80") center/cover;
            color: #eaf2ff;
        }

        .login-shell {
            width: min(1120px, 100%);
            min-height: 660px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 430px;
            gap: 0;
            overflow: hidden;
            border-radius: 24px;
            background: rgba(3, 15, 36, 0.90);
            border: 1px solid rgba(147, 197, 253, 0.24);
            box-shadow: 0 32px 90px rgba(2, 8, 23, 0.58);
            backdrop-filter: blur(16px);
        }

        .brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 42px;
            background:
                radial-gradient(circle at 82% 20%, rgba(56, 189, 248, 0.24), transparent 30%),
                linear-gradient(135deg, rgba(6, 20, 45, 0.94), rgba(11, 42, 91, 0.78));
        }

        .brand-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .brand-mark,
        .session-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-height: 42px;
            padding: 0 14px;
            border-radius: 12px;
            background: rgba(15, 23, 42, 0.42);
            border: 1px solid rgba(147, 197, 253, 0.22);
            font-weight: 900;
        }

        .brand-mark i,
        .session-pill i {
            color: #38bdf8;
        }

        .session-pill {
            color: #bfdbfe;
            font-size: 13px;
        }

        .brand-copy {
            max-width: 600px;
        }

        .brand-copy span {
            display: inline-flex;
            margin-bottom: 14px;
            color: #38bdf8;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .brand-copy h1 {
            margin: 0;
            color: #ffffff;
            font-size: 54px;
            line-height: 1.02;
        }

        .brand-copy p {
            max-width: 500px;
            margin: 18px 0 0;
            color: #c7d7ee;
            font-size: 16px;
            line-height: 1.7;
        }

        .role-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 30px;
        }

        .role-strip div {
            min-height: 118px;
            display: grid;
            align-content: space-between;
            gap: 14px;
            padding: 16px;
            border-radius: 16px;
            background: rgba(248, 251, 255, 0.08);
            border: 1px solid rgba(147, 197, 253, 0.18);
            color: #eaf2ff;
            font-weight: 850;
        }

        .role-strip i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: rgba(56, 189, 248, 0.14);
            color: #7dd3fc;
            font-size: 19px;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 42px;
            background: linear-gradient(180deg, #f8fbff 0%, #eaf2ff 100%);
            color: #06142d;
        }

        .form-card {
            width: 100%;
            display: grid;
            gap: 22px;
        }

        .form-heading i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: #06142d;
            color: #38bdf8;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .form-heading h2 {
            margin: 0 0 8px;
            color: #06142d;
            font-size: 34px;
        }

        .form-heading p {
            margin: 0;
            color: #52657d;
            line-height: 1.6;
        }

        .alert-error {
            padding: 13px 15px;
            border-radius: 12px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            font-size: 14px;
            font-weight: 800;
        }

        form {
            display: grid;
            gap: 17px;
            margin: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #102033;
            font-size: 14px;
            font-weight: 900;
        }

        .field {
            position: relative;
        }

        .field i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #1d4ed8;
        }

        input {
            width: 100%;
            min-height: 56px;
            padding: 0 16px 0 46px;
            border: 1px solid #bfdbfe;
            border-radius: 14px;
            background: #ffffff;
            color: #06142d;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.15);
        }

        .login-btn {
            min-height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 0;
            border-radius: 14px;
            background: #06142d;
            color: #ffffff;
            cursor: pointer;
            font-size: 15px;
            font-weight: 900;
            box-shadow: 0 16px 28px rgba(6, 20, 45, 0.26);
        }

        .login-btn:hover {
            background: #1d4ed8;
        }

        .login-help {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 14px;
            border-radius: 14px;
            background: #dbeafe;
            color: #334155;
            font-size: 13px;
            line-height: 1.5;
        }

        .login-help i {
            color: #1d4ed8;
            margin-top: 2px;
        }

        @media (max-width: 920px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .brand-panel {
                min-height: 430px;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 12px;
            }

            .brand-panel,
            .form-panel {
                padding: 26px;
            }

            .brand-top,
            .role-strip {
                grid-template-columns: 1fr;
            }

            .brand-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .brand-copy h1 {
                font-size: 38px;
            }

            .form-heading h2 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="brand-panel">
            <div class="brand-top">


                <div class="session-pill">
                    <i class="bi bi-shield-lock-fill"></i>
                    Secure Access
                </div>
            </div>

            <div class="brand-copy">
                <span>School Management System</span>
                <h1>Welcome back to your dashboard.</h1>
                <p>Sign in once and continue to the workspace assigned to your account role.</p>

                <div class="role-strip">
                    <div><i class="bi bi-shield-check"></i>Admin controls</div>
                    <div><i class="bi bi-person-video3"></i>Teacher access</div>
                    <div><i class="bi bi-mortarboard"></i>Student profile</div>
                </div>
            </div>
        </section>

        <section class="form-panel">
            <div class="form-card">
                <div class="form-heading">
                    <i class="bi bi-person-lock"></i>
                    <h2>Log in</h2>
                    <p>Use your assigned username and password.</p>
                </div>

                @if(!empty($msg))
                    <div class="alert-error">{{ $msg }}</div>
                @endif

                <form action="/" method="POST">
                    @csrf

                    <div>
                        <label for="username">Username</label>
                        <div class="field">
                            <i class="bi bi-person-fill"></i>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Enter username" autocomplete="username" required>
                        </div>
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <div class="field">
                            <i class="bi bi-lock-fill"></i>
                            <input id="password" type="password" name="password" placeholder="Enter password" autocomplete="current-password" required>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">
                        Open Dashboard
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <div class="login-help">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Supported accounts include admin, teacher, and student roles.</span>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
