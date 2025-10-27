<?php
require_once '../config.php';
require_once '../functions.php';

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = escape($_POST['first_name']);
    $last_name = escape($_POST['last_name']);
    $experience = escape($_POST['experience']);

    // Обработка загрузки файла
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_path = '../images/' . $photo;

    // Перемещаем загруженный файл в нужную директорию
    move_uploaded_file($photo_tmp, $photo_path);

    if (empty($first_name) || empty($last_name) || empty($experience) || empty($photo)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        $sql = "INSERT INTO teachers (first_name, last_name, experience, photo) VALUES ('$first_name', '$last_name', '$experience', '$photo')";
        if ($conn->query($sql) === TRUE) {
            $success = "Преподаватель успешно добавлен.";
        } else {
            $error = "Ошибка при добавлении преподавателя: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить преподавателя</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Добавить преподавателя</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="manage_courses.php">Курсы</a></li>
                <li><a href="manage_teachers.php">Преподаватели</a></li>
                <li><a href="../logout.php">Выйти</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="add-teacher">
            <h2>Добавить нового преподавателя</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="add_teacher.php" method="post" enctype="multipart/form-data">
                <label for="first_name">Имя:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Фамилия:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="experience">Стаж:</label>
                <input type="number" id="experience" name="experience" required>

                <label for="photo">Фото:</label>
                <input type="file" id="photo" name="photo" required>

                <button type="submit">Добавить преподавателя</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> ENONE. Все права защищены.</p>
    </footer>
</body>
</html>
