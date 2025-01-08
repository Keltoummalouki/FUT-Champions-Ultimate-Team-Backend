<?php
require_once('includes/db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}    
    
  
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
    LEFT JOIN clubs ON Player.club_id = clubs.id
    WHERE player.id = '$id' ";
    
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("query failed". mysqli_error($conn));
    } else {
        $res = mysqli_fetch_assoc($result);
                     
    }
  
    if(isset($_POST['update'])) {
        
        $nationality = $_POST['nationality'];
        $club= $_POST['club'];
        $name = $_POST['Player.name'];
        $photo = $_POST['photo']; 
        $rating = $_POST['rating'];
        $rating = $_POST['status'];

        $query  = "update player set nationality = '$nationality' , club = '$club' , Player.name = '$name ' , photo = '$photo', rating = '$rating' , status = '$status'
        where id = '$id' ";

        $result = mysqli_query($conn, $query);

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
    <link href="../assets/styles/dashboard.css" rel="stylesheet">
</head>
<body>
<div class="popup">
    <button class="close-btn">&times;</button>
    <form id="myForm" class="form" action="edit.php?id=<?php echo $id;?>" method="POST" >
        <h2>Edit Player Information</h2>
        <input type="hidden" name="player_id" value="<?php echo htmlspecialchars($player_data['id'] ?? ''); ?>">
        <div class="form-elements">
            <div id="divPhoto">
                <label for="photo">Player Photo</label>
                <input type="url" name="photo" id="photo" class="inputs" 
                    value="<?php echo htmlspecialchars($player_data['photo'] ?? ''); ?>" required>
            </div>
            <div class="name-rate-input">
                <div class="input-name" id="divName">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="inputs"
                        value="<?php echo htmlspecialchars($player_data['name'] ?? ''); ?>" required>
                </div>
                <div id="divRating">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" id="rating" min="20" max="99" class="inputs"
                        value="<?php echo htmlspecialchars($player_data['rating'] ?? ''); ?>" required>
                </div>
            </div>
            <div class="select-position" id="divPosition">
                <label for="position">Position</label>
                <select name="position" id="position" required>
                    <option value="" disabled>Select Position</option>
                    <option value="Defender central (CB)" <?php echo ($player_data['position'] === 'Defender central (CB)') ? 'selected' : ''; ?>>Defender central (CB)</option>
                    <option value="Defender full-back left (LB)" <?php echo ($player_data['position'] === 'Defender full-back left (LB)') ? 'selected' : ''; ?>>Defender full-back left (LB)</option>
                    <option value="Defender full-back right (RB)" <?php echo ($player_data['position'] === 'Defender full-back right (RB)') ? 'selected' : ''; ?>>Defender full-back right (RB)</option>
                    <option value="Defender Midfielder central (CM)" <?php echo ($player_data['position'] === 'Defender Midfielder central (CM)') ? 'selected' : ''; ?>>Defender Midfielder central (CM)</option>
                    <option value="Defender attacking midfielder (CM)" <?php echo ($player_data['position'] === 'Defender attacking midfielder (CM)') ? 'selected' : ''; ?>>Defender attacking midfielder (CM)</option>
                    <option value="Central striker (ST)" <?php echo ($player_data['position'] === 'Central striker (ST)') ? 'selected' : ''; ?>>Central striker (ST)</option>
                    <option value="Winger left (LW)" <?php echo ($player_data['position'] === 'Winger left (LW)') ? 'selected' : ''; ?>>Winger left (LW)</option>
                    <option value="Winger right (RW)" <?php echo ($player_data['position'] === 'Winger right (RW)') ? 'selected' : ''; ?>>Winger right (RW)</option>
                    <option value="Goalkeeper (GK)" <?php echo ($player_data['position'] === 'Goalkeeper (GK)') ? 'selected' : ''; ?>>Goalkeeper (GK)</option>
                </select>
            </div>
            <div class="select-nationality" id="divNationality">
                <label for="nationality">Nationality</label>
                <select name="nationality" id="nationality">
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
            </div>
            <div class="select-club" id="divClub">
                <label for="club">Club</label>
                <select name="club" id="club">
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
            </div>
            <div id="divStatus">
                <label for="status">Status</label>
                <input type="text" name="status" id="status" class="inputs"
                    value="<?php echo htmlspecialchars($player_data['status'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="submit-form-btn">Save Changes</button>
        </div>
    </form>
</div>

<script src="../assets/scripts/dashboard.js"></script>
</body>
</html>
