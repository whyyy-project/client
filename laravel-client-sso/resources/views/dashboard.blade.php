<x-layouts.main>
    <style>
        .dashboard-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 2rem;
            box-shadow: 0 10px 32px 0 rgba(31, 38, 135, 0.25), 0 1.5px 6px 0 rgba(0, 0, 0, 0.08);
            padding: 3rem 2.5rem 2.5rem 2.5rem;
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            transform: perspective(900px) rotateY(7deg) scale(1.01);
            transition: transform 0.3s cubic-bezier(.25, .8, .25, 1);
        }

        .dashboard-card:hover {
            transform: perspective(900px) rotateY(0deg) scale(1.04);
        }

        .dashboard-title {
            font-weight: 800;
            font-size: 2.2rem;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #0072ff;
            text-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        }

        .dashboard-welcome {
            font-size: 1.2rem;
            color: #444;
            text-align: center;
            margin-bottom: 2rem;
        }

        .dashboard-actions {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .dashboard-action-btn {
            border-radius: 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 4px 16px 0 rgba(44, 62, 80, 0.10);
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .dashboard-action-btn:active {
            transform: scale(0.97);
            box-shadow: 0 2px 8px 0 rgba(44, 62, 80, 0.10);
        }
    </style>

    <div class="dashboard-card">
        <div class="dashboard-title">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </div>
        <div class="dashboard-welcome">
            Welcome to your modern dashboard!<br>
            <span style="color:#0072ff;font-weight:600;">Enjoy your stay.</span>
        </div>
        <div class="dashboard-actions">
            <button class="btn btn-primary dashboard-action-btn">
                <i class="fa-solid fa-user"></i> Profile
            </button>
            <button class="btn btn-success dashboard-action-btn">
                <i class="fa-solid fa-cog"></i> Settings
            </button>
        </div>
    </div>

</x-layouts.main>