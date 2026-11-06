<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Soft UI</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #e0e5ec;
            --text-color: #333333;
            --text-muted: #666666;
            --icon-black: #111111;
            --shadow-light: #ffffff;
            --shadow-dark: #a3b1c6;
            
            /* Neumorphic Shadows */
            --neu-flat: 6px 6px 12px var(--shadow-dark), -6px -6px 12px var(--shadow-light);
            --neu-card: 10px 10px 20px var(--shadow-dark), -10px -10px 20px var(--shadow-light);
            --neu-pressed: inset 4px 4px 8px var(--shadow-dark), inset -4px -4px 8px var(--shadow-light);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            transition: all 0.25s ease;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .dashboard-container {
            width: 100%;
            max-width: 380px;
        }

        .neu-card {
            background: var(--bg-color);
            box-shadow: var(--neu-card);
            border-radius: 25px;
            padding: 35px 30px;
            text-align: center;
        }

        /* Top Brand Avatar Icon */
        .brand-icon {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: var(--bg-color);
            box-shadow: var(--neu-flat);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--icon-black);
            margin-bottom: 18px;
        }

        .neu-card h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #222222;
            margin-bottom: 6px;
        }

        .user-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: 20px;
            background: var(--bg-color);
            box-shadow: var(--neu-pressed);
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--icon-black);
            margin-bottom: 24px;
        }

        .user-status i {
            color: #28a745;
            font-size: 0.75rem;
        }

        /* User Details Box */
        .info-card {
            background: var(--bg-color);
            box-shadow: var(--neu-pressed);
            border-radius: 18px;
            padding: 16px 20px;
            margin-bottom: 25px;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-card .info-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--bg-color);
            box-shadow: var(--neu-flat);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--icon-black);
            flex-shrink: 0;
        }

        .info-card .info-text {
            overflow: hidden;
        }

        .info-card .info-text small {
            display: block;
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .info-card .info-text strong {
            font-size: 0.95rem;
            color: #222222;
            word-break: break-all;
        }

        /* Logout Button */
        .btn-logout {
            width: 100%;
            padding: 12px;
            border: none;
            outline: none;
            border-radius: 25px;
            background: var(--bg-color);
            color: #c53030;
            font-size: 0.98rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            box-shadow: var(--neu-flat);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-logout i {
            color: var(--icon-black);
            font-size: 1rem;
        }

        .btn-logout:hover {
            box-shadow: var(--neu-pressed);
            transform: scale(0.98);
        }

        .btn-logout:active {
            box-shadow: inset 4px 4px 8px var(--shadow-dark), inset -4px -4px 8px var(--shadow-light);
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="neu-card">
        
        <!-- Header Black Icon -->
        <div class="brand-icon">
            <i class="fa-solid fa-user-check"></i>
        </div>

        <h2>Welcome Back!</h2>
        
        <div class="user-status">
            <i class="fa-solid fa-circle"></i>
            <span>Online</span>
        </div>

        <!-- User Information Card -->
        <div class="info-card">
            <div class="info-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="info-text">
                <small>Logged in as</small>
                <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong>
            </div>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="btn-logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>

    </div>
</div>

</body>
</html>
