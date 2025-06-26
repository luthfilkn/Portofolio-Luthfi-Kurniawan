<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            background: linear-gradient(120deg, #74ebd5 0%, #ACB6E5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px 30px;
            width: 90vw;
            max-width: 360px;
            border: 1.5px solid rgba(255, 255, 255, 0.28);
            text-align: center;
            color: #2b5876;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 1.6rem;
            text-shadow: 0 2px 6px #fff6;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #e0eafc;
            font-size: 1rem;
        }
        input[type="submit"] {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: linear-gradient(to right, #ACB6E5, #74ebd5);
        }
        .error-message {
            color: red;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }
        @media (max-width: 500px) {
            h2 {
                font-size: 1.2rem;
            }
            .login-container {
                padding: 24px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="proses_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
