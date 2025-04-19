<?php include "../db/db.php";
unset($_SESSION["cart"]);
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    // Если нет информации о предыдущей странице, редиректим на главную
    header('Location: /');
}
exit;
?>


