<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #111827;
            color: white;
            position: fixed;
            padding: 20px;
        }

        .sidebar h2 {
            color: #fff;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            margin: 12px 0;
            padding: 8px;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        /* Main */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        /* Top bar */
        .topbar {
            background: white;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #dc2626;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>MyApp</h2>

        <a href="/dashboard">Dashboard</a>
        <a href="#">Users</a>
        <a href="#">Projects</a>
        <a href="#">Settings</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <!-- TOP BAR -->
        <div class="topbar">
            <div>
                <h3>Welcome, {{ auth()->user()->name }}</h3>
                <small>Role: {{ auth()->user()->role ?? 'user' }}</small>
            </div>

            <!-- LOGOUT (CORRECT POST FORM) -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>                    
            </form>
        </div>

        <!-- DASHBOARD CARDS -->
        <div class="cards">

            <div class="card">
                <h3>Total Users</h3>
                <p>120</p>
            </div>

            <div class="card">
                <h3>Active Projects</h3>
                <p>8</p>
            </div>

            <div class="card">
                <h3>Revenue</h3>
                <p>KES 45,000</p>
            </div>

        </div>

    </div>

</body>
</html>