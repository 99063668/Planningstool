<?php
    include("common/header.php");
    include("includes/functions.php");
    
    $game = getTable("games", $_GET["id"]);
    $person = getTable("plannings", $_GET["id"]);
?>
    <h2>Wijzig de Planning:</h2>
    <br>
    <form method="post" action="planningResult.php">  
        <p><b>Game is: </b><?= $game["name"] ?></p>
        <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
        <input type="hidden" name="game_id" value="<?php echo $game["id"];?>">
        <p><b>Starttijd: </b><input type="time" name="times" required value="<?php echo $times;?>" placeholder="Vul hier de starttijd in"></p>

        <p><b>Host: </b><input type="text" name="host"  placeholder="Vul hier de host in" value="<?php echo $person["host"]?>"></p>

        <label for="players"><b>Spelers: </b></label><br>
        <textarea name="players" cols="30" rows="10" placeholder="Vul hier de spelers in"><?php echo $person["players"]?></textarea><br>
        <button class="btn btn-primary" name="SubmitBtn2" value="confirm">Confirm</button>
    </form>
<?php   
    include("common/footer.php"); 
?>














 <!-- if (empty($data["errors"])) { geen errors
         # code...
     }   -->

<!-- <?php if (!empty($data["errors"]["id"])) { //wel error met de naam id ?>
        <p><?php echo $data["errors"]["id"];?></p>
        <?php } ?> -->