    <?php
    require_once 'config.php';
    require_once 'functions.php';

    //session_start();

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = escape($_POST['email'], $conn); // Добавлено $conn
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Неверный пароль.";
            }
        } else {
            $error = "Пользователь с таким email не найден.";
        }
    }
    ?>
       <div class="login-container">
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
    
