<?php
require_once('includes/db.php');

if (isset($_POST['player_id'])) {

    $player_id = mysqli_real_escape_string($conn, $_POST['player_id']);

    $sql = "DELETE FROM Player WHERE id = '$player_id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: ./index.php');
        exit;
    } else {
        echo "Error deleting player: " . mysqli_error($conn);
    }
} 
?>