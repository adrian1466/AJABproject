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
            display: grid;
            place-items: center;
            padding: 22px;
            background: #eef2f7;
            color: #172033;
        }

        .login-shell {
            width: min(1080px, 100%);
            min-height: 640px;
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            overflow: hidden;
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid #d8e0ea;
            box-shadow: 0 26px 70px rgba(23, 32, 51, 0.18);
        }

        .brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 42px;
            color: #ffffff;
            background:
                linear-gradient(180deg, rgba(9, 26, 52, 0.84), rgba(9, 26, 52, 0.94)),
                url("https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1300&q=80") center/cover;
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
            min-height: 42px;
            padding: 0 14px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            font-weight: 900;
        }

        .brand-copy h1 {
            max-width: 440px;
            margin: 0 0 14px;
            color: #ffffff;
            font-size: 46px;
            line-height: 1.06;
        }

        .brand-copy p {
            max-width: 430px;
            margin: 0;
            color: #dbe7f5;
            line-height: 1.7;
        }

        .role-strip {
            display: grid;
            gap: 10px;
            margin-top: 28px;
        }

        .role-strip div {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(255, 255, 255, 0.14);
            font-weight: 800;
        }

        .role-strip i {
            color: #7dd3fc;
            font-size: 20px;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 54px;
        }

        .form-panel h2 {
            margin: 0 0 8px;
            color: #172033;
            font-size: 34px;
        }

        .form-panel > p {
            margin: 0;
            color: #64748b;
            line-height: 1.6;
        }

        .alert-error {
            margin-top: 22px;
            padding: 13px 15px;
            border-radius: 10px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            font-size: 14px;
            font-weight: 800;
        }

        form {
            display: grid;
            gap: 17px;
            margin-top: 28px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
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
            color: #52657d;
        }

        input {
            width: 100%;
            min-height: 54px;
            padding: 0 16px 0 46px;
            border: 1px solid #ccd6e3;
            border-radius: 12px;
            background: #f8fafc;
            color: #172033;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.14);
        }

        .login-btn {
            min-height: 54px;
            border: 0;
            border-radius: 12px;
            background: #2563eb;
            color: #ffffff;
            cursor: pointer;
            font-size: 15px;
            font-weight: 900;
            box-shadow: 0 14px 26px rgba(37, 99, 235, 0.22);
        }

        .login-btn:hover {
            background: #1d4ed8;
        }

        .login-help {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .login-help i {
            color: #2563eb;
            margin-top: 2px;
        }

        @media (max-width: 860px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .brand-panel {
                min-height: 360px;
            }
        }

        @media (max-width: 560px) {
            body {
                padding: 12px;
            }

            .brand-panel,
            .form-panel {
                padding: 28px;
            }

            .brand-copy h1 {
                font-size: 34px;
            }

            .form-panel h2 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="brand-panel">
            <div class="brand-mark">
                <i class="bi bi-grid-1x2-fill"></i>
                BDC School Portal
            </div>

            <div class="brand-copy">
                <h1>One portal for every school role.</h1>
                <p>Sign in as admin, teacher, or student and continue to the correct workspace automatically.</p>

                <div class="role-strip">
                    <div><i class="bi bi-shield-check"></i>Admin records and controls</div>
                    <div><i class="bi bi-person-video3"></i>Teacher workspace access</div>
                    <div><i class="bi bi-mortarboard"></i>Student profile dashboard</div>
                </div>
            </div>
        </section>

        <section class="form-panel">
            <h2>Sign in</h2>
            <p>Use your assigned username and password.</p>

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

                <button type="submit" class="login-btn">Open Dashboard</button>
            </form>

            <div class="login-help">
                <i class="bi bi-info-circle-fill"></i>
                <span>Supported accounts include admin, teacher, and student roles.</span>
            </div>
        </section>
    </main>
</body>
</html>