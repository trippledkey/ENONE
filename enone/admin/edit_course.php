<?php
require_once '../config.php';
require_once '../functions.php';

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

$error = '';
$success = '';

// Получаем ID курса из GET параметра
if (isset($_GET['id'])) {
    $course_id = escape($_GET['id']);

    // Получаем информацию о курсе из базы данных
    $sql = "SELECT * FROM courses WHERE course_id = '$course_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $course = $result->fetch_assoc();
    } else {
        echo "Курс не найден.";
        exit();
    }
} else {
    echo "Не указан ID курса.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = escape($_POST['course_name']);
    $description = escape($_POST['description']);
    $teacher_id = escape($_POST['teacher_id']);

    if (empty($course_name) || empty($description) || empty($teacher_id)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        $sql = "UPDATE courses SET course_name = '$course_name', description = '$description', teacher_id = '$teacher_id' WHERE course_id = '$course_id'";
        if ($conn->query($sql) === TRUE) {
            $success = "Курс успешно обновлен.";
            // Обновляем информацию о курсе после успешного обновления
            $sql = "SELECT * FROM courses WHERE course_id = '$course_id'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows == 1) {
                $course = $result->fetch_assoc();
            }
        } else {
            $error = "Ошибка при обновлении курса: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать курс</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Редактировать курс</h1>
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
        <section class="edit-course">
            <h2>Редактировать курс</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="edit_course.php?id=<?php echo htmlspecialchars($course['course_id']); ?>" method="post">
                <label for="course_name">Название курса:</label>
                <input type="text" id="course_name" name="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>

                <label for="description">Описание курса:</label>
                <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($course['description']); ?></textarea>

                <label for="teacher_id">Преподаватель:</label>
                <select id="teacher_id" name="teacher_id" required>
                    <?php
                    $teachers = getTeachers();
                    foreach ($teachers as $teacher) {
                        $selected = ($teacher['teacher_id'] == $course['teacher_id']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($teacher['teacher_id']) . "' $selected>" . htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) . "</option>";
                    }
                    ?>
                </select>

                <button type="submit">Сохранить изменения</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> ENONE. Все права защищены.</p>
    </footer>
</body>
</html>
