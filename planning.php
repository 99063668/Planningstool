<?php
    include("common/header.php");
    include("includes/functions.php");
    
    $game = getTable("games", $_GET["id"]); 
?>
    <h2>Planning formulier:</h2>
    <br>
    <form method="post" action="planningResult.php">  
        <p><b>Game is: </b><?= $game["name"] ?></p>
        <input type="hidden" name="game_id" value="<?php echo $game["id"];?>">

        <p><b>Starttijd: </b><input type="time" name="times" required value="<?php echo $times;?>" placeholder="Vul hier de starttijd in"></p>

        <p><b>Host: </b><input type="text" name="host" required value="<?php echo $host;?>" placeholder="Vul hier de host in"></p>

        <label for="players"><b>Spelers: </b></label><br>
        <textarea name="players" cols="30" rows="10" required value="<?php echo $players;?>" placeholder="Vul hier de spelers in"></textarea><br>
        
        <button class="btn btn-primary" name="SubmitBtn" value="confirm">Confirm</button>
    </form>
<?php   
    include("common/footer.php"); 
?>


<!-- Validation code -->
<!-- include("includes/validation.php"); -->
<!-- <span class="error">* <?php echo $playerErr;?></span></p>
<span class="error">* <?php echo $hostErr;?></span></p> -->
