<?php
    include("includes/functions.php");

    if(isset($_GET["id"])){
        $game = getGame($_GET["id"]);
        if(!$game){
            header("location: index.php");
        }
    }else{
        header("location: index.php");
    }

    $games = addGame();

    include("common/header.php");
?>

<div class="row">
    <div class="col-12"><h1><?=$game["name"]?></h1></div>
    <div class="col-6">

        <?=$game["description"]?>

            <p><label class="w-25 font-weight-bold">Expansions: </tabel><?=$game["expansions"]?></p>
            <p><label class="w-25 font-weight-bold">Skills: </tabel><?=$game["skills"]?></p>
            <p><label class="w-25 font-weight-bold">Min spelers: </tabel><?=$game["min-players"]?></p>
            <p><label class="w-25 font-weight-bold">Max spelers: </tabel><?=$game["max_players"]?></p>
            <p><label class="w-25 font-weight-bold">Speeltijd: </tabel><?=$game["play_minutes"]?></p>
            <p><label class="w-25 font-weight-bold">Uitlegtijd: </tabel><?=$game["explain_minutes"]?></p>
            <p><label class="w-25 font-weight-bold">Website: </tabel><a target="_blank" href="<?=$game["url"]?>">Klik hier</a></p>

            
            <form action="planning.php"  method="post">
                <label for="games"><b>Toevoegen aan planning:</b></label>
                <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Add">
            </form>

    </div>
    
        <div class="col-6"><img src="images/<?=$game["image"]?>" alt=""><br><br><?=$game["youtube"]?></div>

</div>

<?php   
    include("common/footer.php"); 
?>
