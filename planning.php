<?php
    include("common/header.php");
    include("includes/functions.php");
?>
    
    <h2>Planning formulier:</h2>
    <br>
    <form method="post" action="planningResult.php">  
        <p><b>Game: </b><input type="text" name="game" required value="<?php echo $game;?>" placeholder="Vul hier de game in"></p>
        <p><b>Starttijd: </b><input type="time" name="time" required value="<?php echo $time;?>" placeholder="Vul hier de starttijd in"></p>
        <p><b>Host: </b><input type="text" name="explain" required value="<?php echo $explain;?>" placeholder="Vul hier de host in"></p>
        <p><b>Spelers: </b><input type="textarea" name="players" required value="<?php echo $players;?>" placeholder="Vul hier de spelers in"></p>
        <button class="btn btn-primary" name="SubmitBtn">Confirm</button>
    </form>

<?php   
    include("common/footer.php"); 
?>
