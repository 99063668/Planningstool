<?php
    include("common/header.php");
    include("includes/functions.php");

    $games = getAllPlannings();
?>
<h2>Planning:</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Game</th>
            <th scope="col">Begintijd</th>
            <th scope="col">Speeltijd</th>
            <th scope="col">Host</th>
            <th scope="col">Spelers</th>
            <th scope="col"> </th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach((array) $games as $game){
        ?>
        <tr>
            <td><?=$game["game"]?></td>
            <td><?=$game["times"]?></td>
            <td><?=$game["duration"]?> minuten</td>
            <td><?=$game["host"]?></td>
            <td><?=$game["players"]?></td>
            <td><a href="planningPage.php?id=<?=$game["id"]?>">Meer&nbsp;info</a></a></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
    
<?php   
    include("common/footer.php"); 
?>
