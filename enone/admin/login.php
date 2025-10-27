<?php
require_once 'config.php';
require_once 'functions.php';

session_start(); // Убедитесь, что сессии включены

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = escape($_POST['email'], $conn);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Успешный вход
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header("Location: index.php"); // Перенаправление в админ-панель
            exit();
        } else {
            $error = "Неверный пароль.";
        }
    } else {
        $error = "Пользователь с таким email не найден.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админ-панель</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Вход в админ-панель</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
