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
    $course_name = escape($_POST['course_name']);
    $description = escape($_POST['description']);
    $teacher_id = escape($_POST['teacher_id']);

    if (empty($course_name) || empty($description) || empty($teacher_id)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        $sql = "INSERT INTO courses (course_name, description, teacher_id) VALUES ('$course_name', '$description', '$teacher_id')";
        if ($conn->query($sql) === TRUE) {
            $success = "Курс успешно добавлен.";
        } else {
            $error = "Ошибка при добавлении курса: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить курс</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Добавить курс</h1>
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
        <section class="add-course">
            <h2>Добавить новый курс</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="add_course.php" method="post">
                <label for="course_name">Название курса:</label>
                <input type="text" id="course_name" name="course_name" required>

                <label for="description">Описание курса:</label>
                <textarea id="description" name="description" rows="5" required></textarea>

                <label for="teacher_id">Преподаватель:</label>
                <select id="teacher_id" name="teacher_id" required>
                    <?php
                    $teachers = getTeachers();
                    foreach ($teachers as $teacher) {
                        echo "<option value='" . htmlspecialchars($teacher['teacher_id']) . "'>" . htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) . "</option>";
                    }
                    ?>
                </select>

                <button type="submit">Добавить курс</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> ENONE. Все права защищены.</p>
    </footer>
</body>
</html>
