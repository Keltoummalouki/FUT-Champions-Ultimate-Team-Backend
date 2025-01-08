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
        clubs.logo AS club 
        FROM Player
        LEFT JOIN nationality ON Player.nationality_id = nationality.id
        LEFT JOIN clubs ON Player.club_id = clubs.id";
        $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team</title>
    <link rel="stylesheet" href="../assets/styles/club.css">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link rel="stylesheet" href="../assets/styles/dashboard.css">

</head>

<body>
    <?php require_once('../includes/sidebar.php');?>

                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($club = mysqli_fetch_assoc($result)) {
                                        echo '<div class="card" >
                                        <div class="photo">
                                        <img src="' . $team['photo'] . '" class="img-output photo-player" alt="Player Photo">
                                        </div>
                                        <div id="name-place">
                                        <h3>' .$team['name'].' </h3>
                                        </div>
                                        <div class="rat-rate">${player.rating}</div>

                                        <div class="club-flag">
                                            <img src="' . $team['nationality'] . '" class="img-output " alt="Nationality Flag" >
                                            <<img src="' . $team['club'] . '" class="img-output " id="club-img" alt="club logo">
                                        </div>
                                        <div class="stats">
                                            <div id="stats-1">
                                                <div class="content-stats">
                                                    <div>PAC</div><div>${player.pace}</div>
                                                    <div>SHO</div><div>${player.shooting}</div>
                                                    <div>PAS</div><div>${player.passing}</div>
                                                </div>
                                            </div>
                                            <div id="stats-2">
                                                <div class="content-stats">
                                                    <div>DRI</div><div>${player.dribbling}</div>
                                                    <div>DEF</div><div>${player.defending}</div>
                                                    <div>PHY</div><div>${player.physical}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                }
                                ?>
</body>
</html>