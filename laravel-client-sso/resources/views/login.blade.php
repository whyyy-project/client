<x-layouts.main>
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .login-3d-card {
            background: rgba(255,255,255,0.95);
            border-radius: 2rem;
            box-shadow: 0 10px 32px 0 rgba(31, 38, 135, 0.37), 0 1.5px 6px 0 rgba(0,0,0,0.08);
            padding: 3rem 2.5rem 2.5rem 2.5rem;
            max-width: 370px;
            width: 100%;
            margin: 0 auto;
            transform: perspective(900px) rotateY(-8deg) scale(1.03);
            transition: transform 0.3s cubic-bezier(.25,.8,.25,1);
        }
        .login-3d-card:hover {
            transform: perspective(900px) rotateY(0deg) scale(1.06);
        }
        .login-title {
            font-weight: 700;
            font-size: 2rem;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            text-align: center;
            color: #2d3748;
            text-shadow: 0 2px 8px rgba(44,62,80,0.08);
        }
        .btn-3d {
            box-shadow: 0 4px 16px 0 rgba(44, 62, 80, 0.12);
            border-radius: 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1.2rem;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-3d:active {
            transform: scale(0.97);
            box-shadow: 0 2px 8px 0 rgba(44, 62, 80, 0.10);
        }
        .social-icon {
            margin-left: 0.7rem;
            font-size: 1.3rem;
        }
    </style>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-3d-card">
            <div class="login-title mb-4">
                <span style="color:#ff416c;">Social</span> <span style="color:#0072ff;">App</span>
            </div>
            <form>
                <a href="{{ route('socialite.redirect', 'google') }}" class="btn btn-danger btn-3d w-100 mb-3">
                    <i class="fa-brands fa-google social-icon"></i> Login with Google
                </a>
                <a href="{{ route('socialite.redirect', 'github') }}" class="btn btn-dark btn-3d w-100 mb-3">
                    <i class="fa-brands fa-github social-icon"></i> Login with Github
                </a>
                <a href="{{ route('girione.redirect') }}" class="btn btn-primary btn-3d w-100 mb-3">
                    <i class="fa-solid fa-shield-halved social-icon"></i> Login with GiriOne SSO
                </a>
            </form>
        </div>
    </div>
</x-layouts.main>