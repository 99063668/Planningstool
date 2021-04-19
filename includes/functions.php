<?php
    include("database.php");

    //Haalt alle games op
    function getAllGames(){
        $conn = openDatabase();

        $query = $conn->prepare("SELECT * FROM games");
        $query->execute();

        return $query->fetchAll();
    }

    //Haalt 1 game op
    function getGame($id){
        $conn = openDatabase();

        $query = $conn->prepare("SELECT * FROM games WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        
        return $query->fetch();
    }

    //Voegt 1 game toe aan de planning
    function addGame(){
        $conn = openDatabase();

        if(isset($games)){
            $query = $conn->prepare("INSERT INTO games(name) VALUES (:name)");
            $query->bindParam(":name", $games);
            $query->execute();
        } else {
            console_log('$game= ' . $games);
        }

        return $games;
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
            $data = array(
                "location" => $_POST["location"],
                "id" => $_GET["id"]
            );
            $input = controle($data);
            update($input);
        }
    }
  
      //Console.log
      function console_log($output, $with_script_tags = true){
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if($with_script_tags){
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
