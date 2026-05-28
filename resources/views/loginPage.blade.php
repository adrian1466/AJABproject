<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BDC Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --secondary: #0f766e;
            --dark: #0f172a;
            --muted: #64748b;
            --line: rgba(255, 255, 255, 0.16);
        }

        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
            letter-spacing: 0;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.96), rgba(30, 64, 175, 0.88), rgba(15, 118, 110, 0.82)),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1600&q=80") center/cover;
            color: var(--dark);
        }

        .login-desk {
            width: min(1050px, 100%);
            min-height: 620px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 420px;
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid var(--line);
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.36);
            backdrop-filter: blur(18px);
        }

        .identity-side {
            padding: 54px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background:
                linear-gradient(180deg, rgba(15, 23, 42, 0.58), rgba(15, 23, 42, 0.82)),
                url("https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1300&q=80") center/cover;
        }

        .brand-lockup {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            width: fit-content;
            min-height: 48px;
            padding: 0 14px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.13);
            border: 1px solid rgba(255, 255, 255, 0.18);
            font-size: 18px;
            font-weight: 900;
        }

        .brand-lockup i {
            color: #a7f3d0;
            font-size: 22px;
        }

        .hero-copy h1 {
            max-width: 520px;
            margin: 0 0 18px;
            color: #ffffff;
            font-size: clamp(42px, 6vw, 64px);
            line-height: 1;
            font-weight: 900;
        }

        .hero-copy p {
            max-width: 510px;
            margin: 0;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.82);
            font-size: 17px;
        }

        .role-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 28px;
        }

        .role-strip div {
            min-height: 104px;
            padding: 16px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(10px);
        }

        .role-strip i {
            display: block;
            margin-bottom: 10px;
            color: #67e8f9;
            font-size: 25px;
        }

        .role-strip span {
            display: block;
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.35;
        }

        .form-side {
            background: #ffffff;
            padding: 52px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-side h2 {
            margin: 0 0 8px;
            color: var(--dark);
            font-size: 36px;
            line-height: 1.1;
        }

        .form-side p {
            margin: 0 0 28px;
            color: var(--muted);
            line-height: 1.6;
        }

        form {
            display: grid;
            gap: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 850;
        }

        .field {
            position: relative;
        }

        .field i {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 18px;
        }

        input {
            width: 100%;
            min-height: 56px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0 18px 0 48px;
            color: var(--dark);
            font-size: 15px;
            background: #f8fafc;
            outline: none;
            transition: border-color 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        input:focus {
            border-color: var(--secondary);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.14);
        }

        .login-btn {
            min-height: 56px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff;
            font-size: 16px;
            font-weight: 900;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 26px rgba(37, 99, 235, 0.24);
        }

        .alert-error {
            padding: 14px;
            border-radius: 8px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 800;
        }

        .login-note {
            margin-top: 22px;
            padding: 15px;
            border-radius: 8px;
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 14px;
            line-height: 1.6;
        }

        .login-note i {
            margin-right: 6px;
            color: var(--primary);
        }

        @media (max-width: 900px) {
            body {
                align-items: flex-start;
            }

            .login-desk {
                grid-template-columns: 1fr;
            }

            .identity-side {
                min-height: 420px;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .identity-side,
            .form-side {
                padding: 30px 24px;
            }

            .role-strip {
                grid-template-columns: 1fr;
            }

            .role-strip div {
                min-height: auto;
            }

            .form-side h2 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <main class="login-desk">
        <section class="identity-side">
            <div class="brand-lockup">
                <i class="bi bi-buildings-fill"></i>
                <span>BDC School Portal</span>
            </div>

            <div class="hero-copy">
                <h1>One portal for every school role.</h1>
                <p>Sign in as admin, teacher, or student and continue to the correct workspace automatically.</p>

                <div class="role-strip">
                    <div>
                        <i class="bi bi-shield-check"></i>
                        <span>Admin records and controls</span>
                    </div>
                    <div>
                        <i class="bi bi-person-video3"></i>
                        <span>Teacher workspace access</span>
                    </div>
                    <div>
                        <i class="bi bi-mortarboard"></i>
                        <span>Student profile dashboard</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-side">
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

            <div class="login-note">
                <i class="bi bi-info-circle-fill"></i>
                Supported accounts include admin, teacher, and student roles.
            </div>
        </section>
    </main>
</body>
</html>
