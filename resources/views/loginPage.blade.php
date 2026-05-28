<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AJAB Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
            letter-spacing: 0;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            background:
                linear-gradient(rgba(5, 12, 26, 0.58), rgba(5, 12, 26, 0.68)),
                url("https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1800&q=85") center/cover;
            color: #0f172a;
        }

        .login-shell {
            width: min(1024px, 100%);
            min-height: 604px;
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(360px, 0.85fr);
            overflow: hidden;
            border-radius: 24px;
            border: 1px solid rgba(147, 197, 253, 0.28);
            box-shadow: 0 30px 80px rgba(2, 8, 23, 0.45);
        }

        .hero-panel {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px;
            background:
                radial-gradient(circle at 74% 22%, rgba(14, 116, 144, 0.42), transparent 34%),
                linear-gradient(135deg, rgba(3, 17, 42, 0.98), rgba(13, 47, 88, 0.96));
            color: #ffffff;
        }

        .secure-pill {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            width: fit-content;
            min-height: 38px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1px solid rgba(147, 197, 253, 0.26);
            color: #dbeafe;
            font-size: 12px;
            font-weight: 800;
        }

        .secure-pill i,
        .kicker,
        .feature-card i,
        .login-icon,
        .note i {
            color: #38bdf8;
        }

        .hero-copy {
            max-width: 620px;
        }

        .kicker {
            display: block;
            margin-bottom: 16px;
            font-size: 12px;
            font-weight: 950;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .hero-copy h1 {
            margin: 0 0 18px;
            max-width: 610px;
            color: #ffffff;
            font-size: clamp(42px, 5vw, 56px);
            line-height: 1.04;
            font-weight: 950;
        }

        .hero-copy p {
            max-width: 560px;
            margin: 0;
            color: #dbeafe;
            font-size: 15px;
            line-height: 1.7;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 30px;
        }

        .feature-card {
            min-height: 108px;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(147, 197, 253, 0.24);
            background: rgba(255, 255, 255, 0.08);
        }

        .feature-card i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            margin-bottom: 16px;
            border-radius: 10px;
            background: rgba(56, 189, 248, 0.12);
            font-size: 18px;
        }

        .feature-card span {
            display: block;
            color: #ffffff;
            font-size: 15px;
            font-weight: 850;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 38px;
            background: #f4f8ff;
        }

        .login-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            margin-bottom: 24px;
            border-radius: 13px;
            background: #04132c;
            font-size: 20px;
        }

        .form-panel h2 {
            margin: 0 0 8px;
            color: #0f172a;
            font-size: 34px;
            line-height: 1.1;
            font-weight: 950;
        }

        .form-panel p {
            margin: 0 0 28px;
            color: #475569;
            font-size: 14px;
        }

        .alert-error {
            padding: 13px 14px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #991b1b;
            font-size: 14px;
            font-weight: 850;
        }

        form {
            display: grid;
            gap: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #0f172a;
            font-size: 13px;
            font-weight: 900;
        }

        .field {
            position: relative;
        }

        .field i {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #2563eb;
            font-size: 15px;
        }

        input {
            width: 100%;
            min-height: 50px;
            padding: 0 16px 0 44px;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            background: #ffffff;
            color: #0f172a;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.13);
        }

        .login-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
            margin-top: 2px;
            border: 0;
            border-radius: 12px;
            background: #04132c;
            color: #ffffff;
            font-size: 15px;
            font-weight: 950;
            cursor: pointer;
            box-shadow: 0 18px 28px rgba(4, 19, 44, 0.22);
        }

        .login-btn:hover {
            background: #0b1e42;
        }

        .note {
            display: flex;
            gap: 10px;
            margin-top: 24px;
            padding: 15px;
            border-radius: 10px;
            background: #dbeafe;
            color: #0f172a;
            font-size: 13px;
            line-height: 1.55;
        }

        @media (max-width: 900px) {
            body {
                place-items: start center;
            }

            .login-shell {
                grid-template-columns: 1fr;
            }

            .hero-panel {
                min-height: 500px;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 12px;
            }

            .hero-panel,
            .form-panel {
                padding: 28px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="hero-panel">
            <div class="secure-pill">
                <i class="bi bi-shield-fill-check"></i>
                <span>Secure Access</span>
            </div>

            <div class="hero-copy">
                <span class="kicker">School Management System</span>
                <h1>Welcome back to your dashboard.</h1>
                <p>Sign in once and continue to the workspace assigned to your account role.</p>

                <div class="feature-grid">
                    <div class="feature-card">
                        <i class="bi bi-shield-check"></i>
                        <span>Admin controls</span>
                    </div>
                    <div class="feature-card">
                        <i class="bi bi-person-video3"></i>
                        <span>Teacher access</span>
                    </div>
                    <div class="feature-card">
                        <i class="bi bi-mortarboard"></i>
                        <span>Student profile</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-panel">
            <i class="login-icon bi bi-person-lock"></i>
            <h2>Log in</h2>
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

                <button type="submit" class="login-btn">
                    <span>Open Dashboard</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="note">
                <i class="bi bi-info-circle-fill"></i>
                <span>Supported accounts include admin, teacher, and student roles.</span>
            </div>
        </section>
    </main>
</body>
</html>
