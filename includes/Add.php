<?php
    include("includes/functions.php");

    $games = addGame();

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?=$games['id'];?>"  method="post">
    <label for="games"><b>Add game:</b></label>
    <input name="games" id="games" class="form-control"></input>
    <input type="submit" name="submit" value="Add">
</form>
