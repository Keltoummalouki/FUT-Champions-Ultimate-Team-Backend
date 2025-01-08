<?php
    require_once('includes/db.php');

    $query = "SELECT DISTINCT 
    clubs.club AS club,
    clubs.logo AS logo,
    clubs.id AS id
    FROM clubs";
        $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
    <link rel="stylesheet" href="../assets/styles/club.css">
    <link rel="stylesheet" href="../assets/styles/dashboard.css">
</head>

<body>
<?php require_once('../includes/sidebar.php');?>
        <div class="carte-container">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($team = mysqli_fetch_assoc($result)) {
                    $club = htmlspecialchars($team['club']);
                    $logo = htmlspecialchars($team['logo']);
                    $id = htmlspecialchars($team['id']);
                    
                    echo '<div class="carte-style">';
                    echo '<h2 class="output">' . $club . '</h2>';
                    if (!empty($logo)) {
                        echo '<img src="' . $logo . '" class="img-output" alt="club logo">';
                    } else {
                        echo '<p>Logo non disponible</p>';
                    }
                    echo '<form method="POST" action="includes/delete.php">
                            <input type="hidden" name="club_id" value="' . $id . '">
                            <button type="submit" class="delete-btn">
                                <img src="./assets/media/icons/delete-icon.png" class="icon-output" alt="delete-icon">
                            </button>
                        </form>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucune équipe trouvée.</p>';
            }
            ?>
        </div>

</body>
</html>