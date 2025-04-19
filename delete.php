<?php include "db/db.php";

// Удаляет товар из сессии
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["session_del_id"])){
    $key = $_GET["session_del_id"];
    if(isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);
    }
}

if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    // Если нет информации о предыдущей странице, редиректим на главную
    header('Location: /');
}
exit;