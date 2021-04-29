<?php
    include("includes/functions.php");

    if(isset($_GET["id"])){
        $game = getTable("games", $_GET["id"]);
        $games = getTable("plannings", $_GET["id"]);
        if(!$game){
            header("location: planningResult.php");
        }
    }else{
        header("location: planningResult.php");
    }
    
?>

<form action="planningPage.php?id=<?= $game["id"]?>"  method="post">
    <label for="Confirm"><b>Are you sure you want to delete this planning?</b></label>
    <button class="btn btn-primary btn-sm" type="submit" name="Delete2" value="true">Yes</button>
    <button class="btn btn-primary btn-sm" type="submit" name="Delete3" value="false">Cancel</button>
</form>