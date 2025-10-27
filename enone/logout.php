<?php
require_once 'functions.php';

// Уничтожаем сессию
session_destroy();

// Перенаправляем на главную страницу
header("Location: index.php");
exit();
?>
