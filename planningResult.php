<?php
    include("common/header.php");
    include("includes/functions.php");
?>
 <link rel="stylesheet" href="styles.css">
<h2>Planning:</h2>

<?php
    $time = $explain = $players = $game = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $game = $_POST["game"];
        $time = $_POST["time"];
        $explain = $_POST["explain"];
        $players = $_POST["players"];

        echo "<b> Game: </b>" . $game;
        echo "<br>";
        echo "<b> Starttijd: </b>" . $time;
        echo "<br>";
        echo "<b> Host: </b>" . $explain;
        echo "<br>";
        echo "<b> Spelers: </b>" . $players;
?>
    <br>
    <form method="post" action="planning.php">  
    <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Edit"> 
    </form>
    <button class="btn btn-primary btn-sm" onclick="document.getElementById('id01').style.display='block'">Delete</button>

    <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
    <form class="modal-content" action="/action_page.php">
        <div class="container">
        <h1>Delete planning</h1>
        <p>Are you sure you want to delete this planning?</p>
        
        <div class="clearfix">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn btn-danger btn-sm">Cancel</button>
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="deletebtn btn-success btn-sm">Delete</button>
        </div>
        </div>
    </form>
    </div>
    

<?php
     }
?>
<?php   
    include("common/footer.php"); 
?>
