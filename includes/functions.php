<?php
    include("database.php");

    //Haalt alle games op
    function getAllGames(){
        $conn = openDatabase();

        $query = $conn->prepare("SELECT * FROM games");
        $query->execute();

        return $query->fetchAll();
    }
    
    //Haalt alle plannings op
    function getAllPlannings(){
        $conn = openDatabase();

        $query = $conn->prepare("SELECT * FROM plannings");
        $query->execute();

        return $query->fetchAll();
    }


    //Voegt de plannings game en de game id samen
    // function getAllPlanningGames(){
    //     $conn = openDatabase();
    //     $query = $conn->prepare("SELECT * FROM plannings LEFT JOIN games ON plannings.game = games.id");
    //     $query->execute();

    //     return $query->fetchAll();
    // }

    //Haalt 1 game op
    function getTable($table, $id){
        $conn = openDatabase();
        $id = intval($id);
        try {
            if (($table == "games" || $table == "plannings") && isset($id) && !empty($id) && is_numeric($id)) {
                $query = $conn->prepare("SELECT * FROM `$table` WHERE id = :id");
                $query->bindParam(":id", $id);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                return $result;
            }
        } catch(PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
      
    }

    //Haalt 1 planning edit op
    // function getPlanning($id){
    //     $conn = openDatabase();
    //     $id = intval($id);
    //     var_dump($id);
    //     if (isset($id) && !empty($id) && is_numeric($id)) {
    //         $query = $conn->prepare("SELECT * FROM plannings WHERE id = :id");
    //         $query->bindParam(":id", $id);
    //         $query->execute();
    //         $result = $query->fetch(PDO::FETCH_ASSOC);

    //         return $result;
    //     }    
    // }

    //Voegt 1 game toe aan de planning
    function addGame($data){
        $conn = openDatabase();

        if(!empty($data) && isset($data)){
            if (isset($data["game_id"]) && !empty($data["game_id"]) && isset($data["times"]) && !empty($data["times"]) && isset($data["duration"]) && !empty($data["duration"]) && isset($data["host"]) && !empty($data["host"]) && isset($data["players"]) && !empty($data["players"])) {
                $query = $conn->prepare("INSERT INTO plannings(game, times, duration, host, players) VALUES (:game, :times, :duration, :host, :players)");
                $query->bindParam(":game", $data["game_id"]);
                $query->bindParam(":times", $data["times"]);
                $query->bindParam(":duration", $data["duration"]);
                $query->bindParam(":host", $data["host"]);
                $query->bindParam(":players", $data["players"]);
                $query->execute();

                return $data;
            }
        }else{
            echo("error empty post game bij function controle.");
        }
    }

    // Verwijderd 1 game uit de planning
    function deleteGame($id){
        $conn = openDatabase();
        $id = intval($id);
        $check = getTable("plannings", $id);

        if (!empty($id) && isset($id) && is_numeric($id) && !empty($check) && isset($check)){
            $query = $conn->prepare("DELETE FROM plannings WHERE id = :id");
            $query->bindParam(":id", $id);
            $query->execute(); 
        } 
    }

    //Edit een game uit de planning
    function editGame($data){
        $conn = openDatabase();
        $data["id"] = intval($data["id"]);
        $check = getTable("plannings", $data["id"]);
        echo $data["id"];

        if(!empty($data["id"]) && isset($data["id"]) && is_numeric($data["id"]) && !empty($check) && isset($check)){
            $query = $conn->prepare("UPDATE plannings SET times=:times, duration=:duration, host=:host, players=:players  WHERE id=:id");
            $query->bindParam(":times", $data["times"]);
            $query->bindParam(":duration",  $data["duration"]);
            $query->bindParam(":host",  $data["host"]);
            $query->bindParam(":players",  $data["players"]);
            $query->bindParam(":id", $data["id"]);
            $query->execute(); 
        }  
    }

    //Controleert de input van forms
    function controle(){
        $data = [];
        
        if(!empty($_POST["id"])){
            $id = trimdata($_POST["id"]);
            settype($id, "int");
            $planning = getTable("plannings", $id);

            if(!is_numeric($id) && isset($planning) && !empty($planning)){
                echo("Er bestaat geen planning met dit id!");
            }else{
                $data["id"] = $id;
            }
        }

        if(!empty($_POST["game_id"])){
            $game_id = trimdata($_POST["game_id"]);
            settype($game_id, "int");
            $game = getTable("game", $game_id);

            if(!is_numeric($id) && isset($game) && !empty($game)){
                echo("Er bestaat geen game met dit id!");
            }else{
                $data["game_id"] = $game_id;
            }
        }

        if(!empty($_POST["times"])){
            $times = trimdata($_POST["times"]);
            if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $times)){
                echo("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["times"] = $times;
            }
        }

        if(!empty($_POST["game_id"])){
            $game = getTable("games", trimdata($_POST["game_id"]));
            $duration_game = optellen_game_duration($game["play_minutes"], $game["explain_minutes"]);

            $data["duration"] = $duration_game;
        }

        if(!empty($_POST["host"])){
            $host = trimdata($_POST["host"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $host)){
                echo("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["host"] = $host;
            }
        }

        if(!empty($_POST["players"])){
            $players = trimdata($_POST["players"]);
            if(!preg_match("/^[a-zA-Z-' , ]*$/", $players)){
                echo("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["players"] = $players;
            }
        }

        return $data;
    }

    //Telt de game minutenen uitleg minuten bij elkaar op
    function optellen_game_duration($minuten1, $minuten2){
        $minuten1 = intval($minuten1);
        $minuten2 = intval($minuten2);

        if(!empty($minuten1) && !empty($minuten2) && is_numeric($minuten1) && is_numeric($minuten2)){
            $duration_game = $minuten1 + $minuten2;
            return $duration_game;
        }
    }

    //Controleert de input op verboden characters
    function trimdata($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    //..
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST["submit"])) {
            $input = controle();
        } elseif (!empty($_POST["SubmitBtn"])) {
            $input = controle();
            addGame($input);
        } elseif (!empty($_POST["Delete"])) {
            //Show confirm form
        } elseif (!empty($_POST["Delete2"])) {
            deleteGame($_GET["id"]);
            header("location: planningResult.php");
        } elseif (!empty($_POST["Delete3"])) {
            header("location: planningPage.php");
        }elseif (!empty($_POST["SubmitBtn2"])) {
                $input = controle();
                editGame($input);
        }
    }
?>
