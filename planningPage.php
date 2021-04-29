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

    include("common/header.php");
?>

<div class="row">
    <div class="col-12"><h1><?=$game["name"]?></h1></div>
    <div class="col-6">

        <?=$game["description"]?>

            <p><label class="w-25 font-weight-bold">Expansions: </tabel><?=$game["expansions"]?></p>
            <p><label class="w-25 font-weight-bold">Skills: </tabel><?=$game["skills"]?></p>
            <p><label class="w-25 font-weight-bold">Min spelers: </tabel><?=$game["min_players"]?></p>
            <p><label class="w-25 font-weight-bold">Max spelers: </tabel><?=$game["max_players"]?></p>
            <p><label class="w-25 font-weight-bold">Speeltijd: </tabel><?=$game["play_minutes"]?></p>
            <p><label class="w-25 font-weight-bold">Uitlegtijd: </tabel><?=$game["explain_minutes"]?></p>
            <p><label class="w-25 font-weight-bold">Website: </tabel><a target="_blank" href="<?=$game["url"]?>">Klik hier</a></p>

            <br>
            <p><b> Starttijd: </b> <?=$games["times"]; ?></p>
            <p><b> Speeltijd: </b> <?=$games["duration"]; ?> minuten</p>
            <p><b> Host: </b> <?=$games["host"]; ?></p>
            <p><b> Spelers: </b> <?=$games["players"]; ?></p>
            <br>
            
            <!-- <form action="planningPage.php?id=<?= $game["id"]?>"  method="post">
                <label for="Edit"><b>Planning wijzigen:</b></label>
                <input class="btn btn-primary btn-sm" type="submit" name="Edit" value="Edit">
            </form> -->

            <form action="form.php?id=<?= $game["id"]?>" method="post">
                <label for="Delete"><b>Planning verwijderen:</b></label>
                <button class="btn btn-primary btn-sm" type="submit" name="Delete" value="Delete">Delete</button>
            </form>

            <!-- <form action="planningPage.php?id=<?= $game["id"]?>"  method="post">
                <label for="Confirm"><b>Are you sure you want to delete this planning?</b></label>
                <button class="btn btn-primary btn-sm" type="submit" name="Delete2" value="true">Yes</button>
                <button class="btn btn-primary btn-sm" type="submit" name="Delete2" value="false">Cancel</button>
            </form> -->
    </div>
    
        <div class="col-6"><img src="images/<?=$game["image"]?>" alt=""><br><br><?=$game["youtube"]?></div>

       

</div>

<?php   
    include("common/footer.php"); 
?>
