<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛒</text></svg>" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.46.0/tabler-icons.min.css" />

    <style>
        /* ============================================
           DESIGN TOKENS
        ============================================ */
        :root {
            --primary: #0aad0a;
            --primary-dark: #088a08;
            --primary-light: #e8ffe6;
            --primary-soft: #dcfce7;

            --surface: #ffffff;
            --surface-2: #f8fafc;
            --surface-3: #f1f5f9;

            --border: #e5e7eb;
            --border-soft: #edf0f2;

            --text: #1f2937;
            --text-2: #4b5563;
            --text-3: #6b7280;
            --text-4: #9ca3af;

            --red: #dc2626;
            --red-soft: #fee2e2;

            --radius: 14px;
            --radius-sm: 10px;
            --radius-lg: 18px;

            --shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 12px 24px rgba(0, 0, 0, 0.08);
        }

        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: var(--text);
            background: var(--surface-2);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        a { color: inherit; text-decoration: none; }
        button { font-family: inherit; cursor: pointer; border: none; background: none; }
        h1, h2, h3, h4, h5, h6 { margin: 0; font-weight: 700; }
        p { margin: 0; }
        input { font-family: inherit; font-size: 14px; }

        /* ============================================
           AUTH LAYOUT
        ============================================ */
        .auth-wrapper {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 900px) {
            .auth-wrapper { grid-template-columns: 1fr; }
        }

        /* ============================================
           LEFT SIDE — BRANDING
        ============================================ */
        .auth-brand {
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background:#0aad0a;
            position: relative;
            overflow: hidden;
        }

        .auth-brand::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 320px;
            height: 320px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .auth-brand::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        @media (max-width: 900px) {
            .auth-brand { display: none; }
        }

        .auth-brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .auth-brand-logo-icon {
            width: 48px;
            height: 48px;
            background:#f1f5f9;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .auth-brand-logo h1 {
            font-size: 20px;
            font-weight: 800;
            margin: 0;
        }

        .auth-brand-logo span {
            font-size: 12px;
            opacity: 0.85;
        }

        .auth-brand-content {
            position: relative;
            z-index: 1;
            max-width: 440px;
        }

        .auth-brand-content h2 {
            font-size: 36px;
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .auth-brand-content p {
            font-size: 15px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 32px;
        }

        .auth-features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .auth-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .auth-feature-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .auth-brand-footer {
            font-size: 12px;
            opacity: 0.7;
            position: relative;
            z-index: 1;
        }

        /* ============================================
           RIGHT SIDE — FORM
        ============================================ */
        .auth-form-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background: var(--surface);

        }

        .auth-form {
            width: 100%;
            max-width: 400px;
        }

        .auth-form-header {
            margin-bottom: 32px;
        }

        .auth-form-header h2 {
            font-size: 26px;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .auth-form-header p {
            font-size: 14px;
            color: var(--text-3);
        }

        /* ============================================
           FORM ELEMENTS
        ============================================ */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-label .required { color: var(--red); margin-left: 2px; }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-4);
            font-size: 18px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 44px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            outline: none;
            transition: all 0.15s;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(10, 173, 10, 0.12);
        }

        .form-control.is-invalid {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-control::placeholder { color: var(--text-4); }

        .form-error {
            display: block;
            font-size: 12px;
            color: var(--red);
            margin-top: 6px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-3);
            font-size: 18px;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.15s;
        }

        .toggle-password:hover {
            background: var(--surface-3);
            color: var(--text);
        }

        /* ============================================
           BUTTON
        ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid transparent;
            transition: all 0.15s;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(10, 173, 10, 0.3);
        }

        .btn i { font-size: 18px; }

        /* ============================================
           CHECKBOX
        ============================================ */
        .form-check {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 13.5px;
        }

        .form-check-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-2);
        }

        .form-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .link-primary {
            color: var(--primary);
            font-weight: 600;
            transition: color 0.15s;
        }

        .link-primary:hover { color: var(--primary-dark); }

        /* ============================================
           ALERT
        ============================================ */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.5;
        }

        .alert i {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-success {
            background: var(--primary-soft);
            color: var(--primary-dark);
            border: 1px solid #86efac;
        }

        .alert-danger {
            background: var(--red-soft);
            color: var(--red);
            border: 1px solid #fca5a5;
        }

        /* ============================================
           DIVIDER
        ============================================ */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: var(--text-4);
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ============================================
           FOOTER LINK
        ============================================ */
        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: var(--text-3);
        }

        .auth-footer a {
            color: var(--primary);
            font-weight: 600;
            margin-left: 4px;
        }

        .auth-footer a:hover { color: var(--primary-dark); }

        /* ============================================
           MOBILE LOGO
        ============================================ */
        .mobile-logo {
            display: none;
            align-items: center;
            gap: 10px;
            margin-bottom: 32px;
        }

        .mobile-logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
        }

        .mobile-logo h1 {
            font-size: 18px;
            font-weight: 800;
        }

        @media (max-width: 900px) {
            .mobile-logo { display: flex; }
        }
    </style>

    <title>@yield('title', 'Auth') — FreshCart Minimarket</title>
</head>

<body>

    <div class="auth-wrapper">

        {{-- LEFT SIDE: BRANDING --}}
        <div class="auth-brand">
            <div class="auth-brand-logo">
                <div class="auth-brand-logo-icon">🛒</div>
                <div>
                    <h1>FreshCart</h1>
                    <span>Minimarket System</span>
                </div>
            </div>

            <div class="auth-brand-content">
                <h2>@yield('brand-title', 'Kelola Minimarket Anda dengan Mudah')</h2>
                <p>@yield('brand-sub', 'Sistem manajemen minimarket modern untuk mengelola produk, supplier, customer, dan transaksi dalam satu dashboard terintegrasi.')</p>

                <div class="auth-features">
                    <div class="auth-feature">
                        <div class="auth-feature-icon">📊</div>
                        <span>Dashboard real-time & analitik penjualan</span>
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon">📦</div>
                        <span>Manajemen katalog & stok produk</span>
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon">🚚</div>
                        <span>Kelola supplier & customer</span>
                    </div>
                    <div class="auth-feature">
                        <div class="auth-feature-icon">🔒</div>
                        <span>Keamanan data terjamin</span>
                    </div>
                </div>
            </div>

            <div class="auth-brand-footer">
                &copy; {{ date('Y') }} FreshCart Minimarket. All rights reserved.
            </div>
        </div>

        {{-- RIGHT SIDE: FORM --}}
        <div class="auth-form-wrap">
            <div class="auth-form">

                {{-- Mobile Logo --}}
                <div class="mobile-logo">
                    <div class="mobile-logo-icon">🛒</div>
                    <h1>FreshCart</h1>
                </div>

                {{-- Header --}}
                <div class="auth-form-header">
                    <h2>@yield('heading', 'Welcome Back')</h2>
                    <p>@yield('subheading', 'Login untuk melanjutkan ke dashboard')</p>
                </div>

                {{-- Success Alert --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="ti ti-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Error Alert (Global) --}}
                @if($errors->any() && !$errors->has('email') && !$errors->has('password') && !$errors->has('name'))
                    <div class="alert alert-danger">
                        <i class="ti ti-alert-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Content --}}
                @yield('content')

            </div>
        </div>

    </div>

    <script>
        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                if (!input) return;

                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';

                this.classList.toggle('ti-eye', !isPassword);
                this.classList.toggle('ti-eye-off', isPassword);
            });
        });
    </script>

</body>

</html>
