<?php
    include("common/header.php");
    include("includes/functions.php");

    $games = getAllGames();
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Naam</th>
            <th scope="col">Afbeelding</th>
            <th scope="col">Skills</th>
            <th scope="col">Min spelers</th>
            <th scope="col">Max spelers</th>
            <th scope="col">Speeltijd</th>
            <th scope="col">Uitlegtijd</th>
            <th scope="col"> </th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($games as $game){
        ?>
        <tr>
            <td><?=$game["name"]?></td>
            <Td><img width="150" src="images/<?=$game["image"]?>" alt="<?=$game["name"]?>"><td>
            <td><?=$game["skills"]?></td>
            <td><?=$game["min_players"]?></td>
            <td><?=$game["max_Players"]?></td>
            <td><?=$game["play_minutes"]?></td>
            <td><?=$game["explain_minutes"]?></td>
            <td><a href="detail.php?id=<?=$game["id"]?>">Meer&nbsp;info</a></a></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<?php   
    include("common/footer.php"); 
?>
