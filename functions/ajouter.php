<?php
    require_once('includes/db.php');

    $query = "SELECT 
        Player.id As id,
        Player.name, 
        Player.photo, 
        Player.position,
        Player.rating,
        Player.status,
        nationality.flag AS nationality, 
        nationality.name , 
        clubs.logo AS club ,
        clubs.club 
        FROM Player
        LEFT JOIN nationality ON Player.nationality_id = nationality.id
        LEFT JOIN clubs ON Player.club_id = clubs.id";
        
        $result = mysqli_query($conn, $query);

?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $photo = mysqli_real_escape_string($conn, $_POST['photo']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $club = mysqli_real_escape_string($conn, $_POST['club']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $insert_query = "
        INSERT INTO Player (name, photo, position, nationality, club, rating, status)
        VALUES ('$name', '$photo', '$position', '$nationality', '$club', '$rating', '$status')
    ";

    if (mysqli_query($conn, $insert_query)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error adding player: " . mysqli_error($conn);
    }
}
?>
