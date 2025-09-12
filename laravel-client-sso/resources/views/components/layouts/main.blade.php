<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background: linear-gradient(120deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;" class="container-fluid">
    <style>
        .glass-navbar {
            background: rgba(255, 255, 255, 0.75);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 1.5rem;
            margin-top: 1.5rem;
            margin-bottom: 2.5rem;
            padding: 0.7rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.7rem;
            letter-spacing: 1px;
            color: #0072ff !important;
            text-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        }

        .navbar-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 8px 0 rgba(44, 62, 80, 0.10);
            margin-left: 1.2rem;
        }

        .navbar-logout-btn {
            border-radius: 1.2rem;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            margin-left: 1rem;
        }

        @media (max-width: 991px) {
            .glass-navbar {
                padding: 0.7rem 1rem;
            }
        }
    </style>
    <nav class="navbar navbar-expand-lg glass-navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <i class="fa-solid fa-comments" style="color:#ff416c;"></i>
                Social <span style="color:#ff416c;">App</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item d-flex align-items-center">
                        @auth
                            <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="navbar-avatar">
                            <form class="d-inline-block ms-2" role="search" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger navbar-logout-btn" type="submit"><i
                                        class="fa-solid fa-right-from-bracket"></i> Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary navbar-logout-btn">
                                <i class="fa-solid fa-right-to-bracket"></i> Login
                            </a>
                        @endauth

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>