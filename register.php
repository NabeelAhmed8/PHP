<?php
include "connect.php";

$message = "";
$msgType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $plainPassword = $_POST["password"];

    if ($name == "" || $email == "" || $plainPassword == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a name, valid email, and password.";
        $msgType = "error";
    } else {
        $passwordHash = password_hash($plainPassword, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $passwordHash);
            $saved = mysqli_stmt_execute($stmt);

            if ($saved) {
                $message = "Registration successful! Redirecting to login...";
                $msgType = "success";
                header("refresh:2; url=login.php");
            } else {
                $message = "Registration failed. Email might already exist.";
                $msgType = "error";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "Registration failed. Please try again.";
            $msgType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Soft UI</title>
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

        .register-container {
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

        /* Top Avatar / Brand Icon */
        .brand-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: var(--bg-color);
            box-shadow: var(--neu-flat);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--icon-black);
            margin-bottom: 18px;
        }

        .neu-card h2 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #222222;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 22px;
        }

        /* Message Alerts */
        .alert {
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 0.86rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-success {
            color: #28a745;
            background: #d4edda;
            box-shadow: inset 2px 2px 5px rgba(40, 167, 69, 0.2);
        }

        .alert-error {
            color: #dc3545;
            background: #f8d7da;
            box-shadow: inset 2px 2px 5px rgba(220, 53, 69, 0.2);
        }

        /* Form Controls */
        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 6px;
            padding-left: 4px;
        }

        .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Black Icons */
        .input-box .field-icon {
            position: absolute;
            left: 16px;
            color: var(--icon-black);
            font-size: 0.95rem;
            pointer-events: none;
        }

        .input-box input {
            width: 100%;
            background: var(--bg-color);
            border: none;
            outline: none;
            padding: 12px 16px 12px 44px;
            border-radius: 20px;
            font-size: 0.92rem;
            color: #222222;
            box-shadow: var(--neu-pressed);
        }

        .input-box input:focus {
            box-shadow: inset 5px 5px 9px var(--shadow-dark), inset -5px -5px 9px var(--shadow-light);
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            color: var(--icon-black);
            cursor: pointer;
            font-size: 0.9rem;
        }

        /* Submit Button */
        .btn-register {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            outline: none;
            border-radius: 25px;
            background: var(--bg-color);
            color: var(--icon-black);
            font-size: 0.98rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: var(--neu-flat);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-register i {
            color: var(--icon-black);
        }

        .btn-register:hover {
            box-shadow: var(--neu-pressed);
            transform: scale(0.98);
        }

        .btn-register:active {
            box-shadow: inset 4px 4px 8px var(--shadow-dark), inset -4px -4px 8px var(--shadow-light);
        }

        /* Bottom Link */
        .footer-text {
            text-align: center;
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-top: 20px;
        }

        .footer-text a {
            color: var(--icon-black);
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="neu-card">
        
        <!-- Header Black Icon -->
        <div class="brand-icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>

        <h2>Register</h2>
        <p class="subtitle">Create your new account</p>

        <!-- Message Display -->
        <?php if (!empty($message)): ?>
            <div class="alert <?= $msgType === 'success' ? 'alert-success' : 'alert-error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form method="POST" action="">
            
            <!-- Name Input -->
            <div class="form-group">
                <label for="name">Name</label>
                <div class="input-box">
                    <i class="fa-solid fa-user field-icon"></i>
                    <input type="text" id="name" name="name" placeholder="Full Name" required autocomplete="name">
                </div>
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-box">
                    <i class="fa-solid fa-envelope field-icon"></i>
                    <input type="email" id="email" name="email" placeholder="name@example.com" required autocomplete="email">
                </div>
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-box">
                    <i class="fa-solid fa-lock field-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Create password" required autocomplete="new-password">
                    <i class="fa-regular fa-eye toggle-password" id="togglePassword"></i>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="register" value="1" class="btn-register">
                <span>Sign Up</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <p class="footer-text">
            Already have an account? <a href="login.php">Login</a>
        </p>

    </div>
</div>

<!-- Password Visibility Toggle Script -->
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }
</script>

</body>
</html>
