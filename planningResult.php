<?php
    include("common/header.php");
    include("includes/functions.php");

    $plannings = getAllPlanningGames();
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
            foreach((array) $plannings as $planning){
        ?>
        <tr>
            <td><?=$planning["name"]?></td>
            <td><?=$planning["times"]?></td>
            <td><?=$planning["duration"]?> minuten</td>
            <td><?=$planning["host"]?></td>
            <td><?=$planning["players"]?></td>
            <td><a href="planningPage.php?id=<?=$planning["id"]?>">Meer&nbsp;info</a></a></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
  
<?php   
    include("common/footer.php"); 
?>
