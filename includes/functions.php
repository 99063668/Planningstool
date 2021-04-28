<?php
  function console_log($output, $with_script_tags = true){
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if($with_script_tags){
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
    }

    include("database.php");

    //Haalt alle games op
    function getAllGames(){
        $conn = openDatabase();

        $query = $conn->prepare("SELECT * FROM games");
        $query->execute();

        return $query->fetchAll();
    }
    
    //Haalt 1 game op
    function getTable($table, $id){
        $conn = openDatabase();

        $id = intval($id);
        if (($table == "games" || $table == "plannings") && isset($id) && !empty($id) && is_numeric($id)) {
            $query = $conn->prepare("SELECT * FROM `$table` WHERE id = :id");
            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result;
        }
    }

    //Voegt 1 game toe aan de planning
    function addGame($data){
        $conn = openDatabase();

        if(!empty($data) && isset($data)){
            if (isset($data["game_id"]) && !empty($data["game_id"]) && isset($data["time1"]) && !empty($data["time1"]) && isset($data["duration"]) && !empty($data["duration"]) && isset($data["host"]) && !empty($data["host"] && isset($data["players"]) && !empty($data["players"])) {
                $query = $conn->prepare("INSERT INTO plannings(game, 'time', duration, host, players) VALUES (:game, :time1, :duration, :host, :players)");
                $query->bindParam(":game", $data["game_id"]);
                $query->bindParam(":time1", $data["time1"]);
                $query->bindParam(":duration", $data["duration"]);
                $query->bindParam(":host", $data["host"]);
                $query->bindParam(":players", $data["players"]);
                $query->execute();

                return $data;
            }
        }else{
            print_r("error empty post game bij function controle.");
        }
    }

    // // Verwijderd 1 game uit de planning
    // function deleteGame($id){
    //     $conn = openDatabase();
    //     console_log("delete game");

            // $query = $conn->prepare("DELETE * FROM plannings WHERE id = :id");
            // $query->bindParam(":id", $id);
            // $query->execute();  
        
    //     return $query->fetch();
    // }

    //Controleert de input van forms
    function controle(){
        $data = [];
        
        if(!empty($_POST["game_id"])){
            $game_id = trimdata($_POST["game_id"]);
            settype($game_id, "int");
            $game = getTable("game", $game_id);

        }if(!is_numeric($id) && isset($game) && !empty($game)){
            print_r("Er bestaat geen game met dit id!");
        }else{
            $data["game_id"] = $game_id;
        }

        if(!empty($_POST["time1"])){
            $time1 = trimdata($_POST["time1"]);
            if(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $time1)){
                print_r("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["time1"] = $time1;
            }
        }

        if(!empty($_POST["game_id"])){
            $game = getTable("games", trimdata($_POST["game_id"]));
            $duration_game = optellen_game_duration($game["play_minutes"], $game["explain_minutes"]);

            $data["duration"] = $duration_game;
            console_log(trimdata($_POST["game_id"]));
        }

        if(!empty($_POST["host"])){
            $host = trimdata($_POST["host"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $host)){
                print_r("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["host"] = $host;
            }
        }

        if(!empty($_POST["players"])){
            $players = trimdata($_POST["players"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $players)){
                print_r("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["players"] = $players;
            }
        }
        console_log($data);
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
    
    //
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST["submit"])) {
            $input = controle();
            addGame($input);
        } elseif (!empty($_POST["SubmitBtn"])) {
            $input = controle();
            addGame($input);
        }
    }

  