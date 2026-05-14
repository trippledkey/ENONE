<?php
require_once '../config.php';
require_once '../functions.php';

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

// Обработка удаления курса
if (isset($_GET['delete_id'])) {
    $delete_id = escape($_GET['delete_id']);
    $sql = "DELETE FROM courses WHERE course_id = '$delete_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Курс успешно удален.</p>";
    } else {
        echo "<p class='error'>Ошибка при удалении курса: " . $conn->error . "</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление курсами</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Управление курсами</h1>
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
        <section class="admin-courses">
            <h2>Список курсов</h2>
            <a href="add_course.php" class="button">Добавить курс</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Преподаватель</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $courses = getCourses(); // Получаем список курсов из функции
                    foreach ($courses as $course) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($course['course_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($course['course_name']) . "</td>";
                        echo "<td>" . htmlspecialchars(substr($course['description'], 0, 100)) . "...</td>";
                        echo "<td>" . htmlspecialchars($course['first_name'] . ' ' . $course['last_name']) . "</td>";
                        echo "<td>
                                <a href='edit_course.php?id=" . htmlspecialchars($course['course_id']) . "' class='button'>Редактировать</a>
                                <a href='manage_courses.php?delete_id=" . htmlspecialchars($course['course_id']) . "' class='button delete-button'>Удалить</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> ENONE. Все права защищены.</p>
    </footer>
    <script>
        // Подтверждение удаления 
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('Вы уверены, что хотите удалить этот курс?')) {
                    event.preventDefault(); // Отменяем переход по ссылке если пользователь отменил удаление
                }
            });
        });
    </script>
</body>
</html>
