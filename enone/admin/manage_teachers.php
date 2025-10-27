<?php
require_once '../config.php';
require_once '../functions.php';

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

// Обработка удаления преподавателя
if (isset($_GET['delete_id'])) {
    $delete_id = escape($_GET['delete_id']);
    $sql = "DELETE FROM teachers WHERE teacher_id = '$delete_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Преподаватель успешно удален.</p>";
    } else {
        echo "<p class='error'>Ошибка при удалении преподавателя: " . $conn->error . "</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление преподавателями</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Управление преподавателями</h1>
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
        <section class="admin-teachers">
            <h2>Список преподавателей</h2>
            <a href="add_teacher.php" class="button">Добавить преподавателя</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Стаж</th>
                        <th>Фото</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $teachers = getTeachers(); // Получаем список преподавателей из функции
                    foreach ($teachers as $teacher) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($teacher['teacher_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($teacher['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($teacher['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($teacher['experience']) . "</td>";
                        echo "<td><img src='../images/" . htmlspecialchars($teacher['photo']) . "' alt='" . htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) . "' width='50'></td>";
                        echo "<td>
                                <a href='edit_teacher.php?id=" . htmlspecialchars($teacher['teacher_id']) . "' class='button'>Редактировать</a>
                                <a href='manage_teachers.php?delete_id=" . htmlspecialchars($teacher['teacher_id']) . "' class='button delete-button'>Удалить</a>
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
        // Подтверждение удаления (необязательно, но рекомендуется)
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('Вы уверены, что хотите удалить этого преподавателя?')) {
                    event.preventDefault(); // Отменяем переход по ссылке, если пользователь отменил удаление
                }
            });
        });
    </script>
</body>
</html>
