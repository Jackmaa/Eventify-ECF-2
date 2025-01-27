<?php
session_start();
include './dbh.class.php';
$connection = new Dbh;
$bdd        = $connection->getConnection();

if (isset($_POST['auto_delete'])) {
    $autoDelete = 1;
} else {
    $autoDelete = 0;
}

$id_user = $_SESSION['userid'];

$stmt = $bdd->prepare('UPDATE `user` SET `auto_delete_past_events` = :auto_delete WHERE `id_user` = :id');
$stmt->bindParam(':auto_delete', $autoDelete, PDO::PARAM_INT);
$stmt->bindParam(':id', $id_user, PDO::PARAM_INT);
$stmt->execute();

header('Location: user-profile.php?id=' . $id_user);
exit();
?>