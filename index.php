<?php


require_once '/vendor/autoload.php';

use MonPackage\MaClasse;

    require_once('./includes/db.php');

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/styles/dashboard.css">
</head>

<body>
    <?php require_once('./includes/sidebar.php');?>



            <div class="box-container">
                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading">
                            <?php 
                                $query = "SELECT COUNT(*) FROM player";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                                echo $count;
                            ?>
                        </h2>
                        <h2 class="topic">Total Players</h2>
                    </div>

                    <img src="./assets/media/icons/soccer-player-white.png"
                        alt="Player">
                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">
                            <?php 
                                $query = "SELECT COUNT(*) FROM nationality";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                                echo $count;
                            ?>
                        </h2>
                        <h2 class="topic">Total nationality</h2>
                    </div>

                    <img src="./assets/media/icons/nationnality.png"
                        alt="nationality">
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">
                            <?php 
                                $query = "SELECT COUNT(*) FROM clubs";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                                echo $count;
                            ?>
                        </h2>
                        <h2 class="topic">Total clubs</h2>
                    </div>

                    <img src="./assets/media/icons/football-club.png"
                        alt="comments">
                </div>

                <div class="box box4">
                    <div class="text">
                        <h2 class="topic-heading">
                            <?php 
                                $query = "SELECT COUNT(*) FROM player WHERE status = 'On the field'";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                                echo $count;
                            ?>
                        </h2>
                        <h2 class="topic">Active player</h2>
                    </div>

                    <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="active">
                </div>
            </div>

            <div class="report-container">
                <div class="report-header">
                    <h1 class="recent-Articles">Recent Players</h1>
                    <button id="add-btn">Add Player</button>

                    <div class="popup">
                        <button class="close-btn">&times;</button>
                            <form id="myForm" class="form"  method="POST" action="ajouter.php">
                                <h2>Player information</h2>
                                <div class="form-elements">
                                    <div id="divPhoto">
                                        <label for="photo">Player photo</label>
                                        <input type="url" placeholder="Player photo URL" id="photo" class="inputs" require/>
                                        <span id="erreurimage" class="erreur-message"></span>
                                    </div>
                                    <div class="name-rate-input">
                                        <div class="input-name" id="divName">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" placeholder="Enter player name" require/>
                                            <span class="erreur-message" id="erreurname"></span>
                                        </div>
                                        <div id="divRating">
                                            <label for="rating">Rating</label>
                                            <input type="number" id="rating" name="rating" min="20" max="99" class="inputs"
                                                placeholder="Rating"require />
                                            <span class="erreur-message" id="erreurrating"></span>
                                        </div>
                                    </div>
                                    <div class="select-position" id="divPosition">
                                    <label for="position">Position</label>
                                        <select id="position">
                                            <option></option>
                                            <option value="Defender central (CB)">Defender central (CB)</option>
                                            <option value="Defender full-back left (LB)">Defender full-back left (LB)</option>
                                            <option value="Defender full-back right (RB)">Defender full-back right (RB)</option>
                                            <option value="Defender Midfielder central (CM)">Defender Midfielder central (CM)
                                            </option>
                                            <option value="Defender attacking midfielder (CM)">Defender attacking midfielder
                                                (CM)</option>
                                            <option value="Central striker (ST)">Central striker (ST)</option>
                                            <option value="Winger left (LW)">Winger left (LW)</option>
                                            <option value="Winger right (RW)">Winger right (RW)</option>
                                            <option value="Goalkeeper (GK)">Goalkeeper (GK)</option>
                                        </select>
                                        <span id="erreur-position" class="erreur-message"></span>
                                    </div>

                                    

                                    <div class="select-nationality" id="divNationality">
                                        <label for="nationality">Nationality</label>
                                    <select name="nationality" id="nationality">
                                        <option value=""></option>
                                        <?php
                                            $query = "select * from nationality";
                                                
                                                $result = mysqli_query($conn, $query);

                                            while($row = mysqli_fetch_assoc($result)){
                                                if ($res['nationality'] == $row['id'] ) {
                                                    echo '<option selected value='.$row["id"].'>'.$row["nationality.name"].'</option>';
                                                }else {
                                                    echo '<option value='.$row["id"].'>'.$row["nationality.name"].'</option>';
                                                }
                                        
                                            }
                                        ?>
                                    </select>
                                        <span id="erreurnationality" class="erreur-message"></span>
                                    </div>

                                    <div class="select-club" id="divClub">
                                        <label for="club">Club</label>
                                        <select name="club" id="club">
                                            <option value=""></option>
                                            <?php
                                                $query = "select * from clubs";
                                                    
                                                    $result = mysqli_query($conn, $query);

                                                while($row = mysqli_fetch_assoc($result)){
                                                    if ($res['club'] == $row['id'] ) {
                                                        echo '<option selected value='.$row["id"].'>'.$row["clubs.club"].'</option>';
                                                    }else {
                                                        echo '<option value='.$row["id"].'>'.$row["name"].'</option>';
                                                    }
                                            
                                                }
                                            ?>
                                        </select>
                                        <span id="erreurclub" class="erreur-message"></span>
                                    </div>
                                    <div class="select-status" id="divstatus">
                                        <label for="status">Status</label>
                                        <select id="status" require>
                                            <option></option>
                                            <option value="On the field">On the field</option>
                                            <option value="reserve">Reserve</option>
                                        </select>
                                        <span id="erreurreserve" class="erreur-message"></span>
                                    </div>
                                    <div class="formation"></div>
                                    <button type="button" id="submit-btn" class="submit-form-btn">
                                        Add player
                                    </button>
                                </div>
                            </form>
                    </div>
                    </div>
                    
                    <div class="table-wrapper">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th class="t-op">Name</th>
                                    <th class="t-op">Photo</th>
                                    <th class="t-op">Position</th>
                                    <th class="t-op">Nationality</th>
                                    <th class="t-op">Club</th>
                                    <th class="t-op">Rating</th>
                                    <th class="t-op">Status</th>
                                    <th class="t-op"></th>
                                    <th class="t-op"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($team = mysqli_fetch_assoc($result)) {
                                        echo '<tr class="tr-style">';
                                        echo '<td class="output">' .$team['name'].' </td>';
                                        echo '<td class="output"><img src="' . $team['photo'] . '" class="img-output photo-player" alt="Player Photo"></td>';
                                        echo '<td class="output">' . $team['position'] . '</td>';
                                        echo '<td class="output"><img src="' . $team['nationality'] . '" class="img-output " alt="Nationality Flag"></td>';
                                        echo '<td class="output"><img src="' . $team['club'] . '" class="img-output " id="club-img" alt="club logo"></td>';
                                        echo '<td class="output">' . $team['rating'] . '</td>';
                                        echo '<td class="output status-output"><h3>' . $team['status'] . ' </h3></td>';

                                        echo '<td>
                                        <form method="POST" action="edit.php?id=<?php echo $id;?>">
                                            <input type="hidden" name="player_id" value="' . ($team['id']) . '">
                                            <button type="submit" class="edit-btn">
                                                <img src="./assets/media/icons/edit-button.png" class="icon-output" alt="edit-icon">
                                            </button>
                                        </form>
                                        </td>';

                                        echo '<td>
                                            <form method="POST" action="../includes/delete.php";">
                                                <input type="hidden" name="player_id" value="' . $team['id'] . '">
                                                <button type="submit" class="delete-btn">
                                                    <img src="./assets/media/icons/delete-icon.png" class="icon-output" alt="delete-icon">
                                                </button>
                                            </form>
                                        </td>';


                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/scripts/dashboard.js"></script>

</body>

</html>