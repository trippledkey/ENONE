<?php
require_once '../config.php';
require_once '../functions.php';

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

$error = '';
$success = '';

// Получаем ID преподавателя из GET параметра
if (isset($_GET['id'])) {
    $teacher_id = escape($_GET['id']);

    // Получаем информацию о преподавателе из базы данных
    $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $teacher = $result->fetch_assoc();
    } else {
        echo "Преподаватель не найден.";
        exit();
    }
} else {
    echo "Не указан ID преподавателя.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = escape($_POST['first_name']);
    $last_name = escape($_POST['last_name']);
    $experience = escape($_POST['experience']);

    // Обработка загрузки нового файла (если он был загружен)
    if ($_FILES['photo']['name']) {
        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $photo_path = '../images/' . $photo;
        move_uploaded_file($photo_tmp, $photo_path);
    } else {
        // Если новый файл не загружен, используем старое имя файла
        $photo = $teacher['photo'];
    }


    if (empty($first_name) || empty($last_name) || empty($experience)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        $sql = "UPDATE teachers SET first_name = '$first_name', last_name = '$last_name', experience = '$experience', photo = '$photo' WHERE teacher_id = '$teacher_id'";
        if ($conn->query($sql) === TRUE) {
            $success = "Преподаватель успешно обновлен.";

            // Обновляем информацию о преподавателе после успешного обновления
            $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows == 1) {
                $teacher = $result->fetch_assoc();
            }


        } else {
            $error = "Ошибка при обновлении преподавателя: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать преподавателя</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Редактировать преподавателя</h1>
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
        <section class="edit-teacher">
            <h2>Редактировать преподавателя</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="edit_teacher.php?id=<?php echo htmlspecialchars($teacher['teacher_id']); ?>" method="post" enctype="multipart/form-data">
                <label for="first_name">Имя:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($teacher['first_name']); ?>" required>

                <label for="last_name">Фамилия:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($teacher['last_name']); ?>" required>

                <label for="experience">Стаж:</label>
                <input type="number" id="experience" name="experience" value="<?php echo htmlspecialchars($teacher['experience']); ?>" required>

                <label for="photo">Фото:</label>
                <img src="../images/<?php echo htmlspecialchars($teacher['photo']); ?>" alt="<?php echo htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']); ?>" width="100">
                <input type="file" id="photo" name="photo"> <!--  Разрешаем загрузить новое фото -->

                <button type="submit">Сохранить изменения</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> ENONE. Все права защищены.</p>
    </footer>
</body>
</html>
