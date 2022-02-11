<?php
require_once('authorize.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" >
    <title>Гитарные войны. Удаления рейтинга</title>
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
    <h2>Гитарные войны</h2>
<?php
require_once('connectvars.php');
require_once('appvars.php');

if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
    // извлечение данных рейтинга из суперглобального массива $_GET \
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
}
 else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
     // извлечение данных рейтинга из суперглобального массива $_POST
     $id = $_POST['id'];
     $name = $_POST['name'];
     $score = $_POST['score'];
 }
 else{
    echo '<p class="error">Извините, ни одного рейтинга не выбрано для удаления</p>';
 }

 if (isset($_POST['submit'])) {
     if ($_POST['confirm'] == 'Yes') {

         // соединение с базой данных
         $dbc = mysqli_connect("localhost", "root", "", "guitar_score");

         // удаление рейтинга страницы подтверждения
         $query = "DELETE FROM guitarwars WHERE id = id LIMIT 1";
         mysqli_query($dbc, $query);
         mysqli_close($dbc);

         // вывод пользователю страницы подтверждения
         echo '<p>Рейтинг со значением ' . $score . ' для пользователя ' . $name . ' был успешно удален из базы данных.</p>';

     } else {
         echo '<p class="error"> Рейтинг не удален.</p>';
     }
 }
 else if (isset($id) && isset($name) && isset($date) && isset($score) && isset($screenshot)){
     echo '<p>Вы уверены, что хотите удалить этот рейтинг</p>';
     echo '<p><strong>Имя: </strong>' . $name . '<br> <strong>Дата: </strong>' . $date . '<br> <strong>Рейтинг: </strong>' . $score . '</p>';
     echo '<from method="post" action="removescore.php">';
     echo '<input type="radio" name="confirm" value="Да"> Да';
     echo '<input type="radio" name="confirm" value="Нет" checked="checked"> Нет <br>';
     echo '<input type="submit" name="confirm" value="Удалить" name="submit">';
     echo '<input type="hidden" name="id" value="' . $id . '">';
     echo '<input type="hidden" name="id" value="' . $id . '">';
     echo '<input type="hidden" name="score" value="' .$score . '">';
     echo '</form>';
 }
 echo '<p><a href="admin.php">&lt;&lt; Назад к списку рейтингов </p>'
?>
</body>
</html>