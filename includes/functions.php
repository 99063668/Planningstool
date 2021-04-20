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
            $query = $conn->prepare("SELECT name FROM games WHERE name = :name");
            $query->bindParam(":name", $games);
            $query->execute();
        } else {
            console_log('$game= ' . $games);
        }

        return $games;
    }

    // Verwijderd 1 game uit de planning
    // function deleteGame($id){
    //     $conn = openDatabase();

    //     if(..){
    //         $query = $conn->prepare("DELETE * FROM planning WHERE id = :id");
    //         $query->bindParam(":id", $id);
    //         $query->execute();
    //     }
        
    //     return $query->fetch();
    // }









    //Controleert de input van addGame
    function controle($data){
        if (!empty($data)) {
            $data["games"] = trimdata($data["games"]);
            $data["id"] = trimdata($data["id"]);
            return $data;
        }else{
            console_log("error empty post game bij function controle.");
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
            $data = array(
                "location" => $_POST["location"],
                "id" => $_GET["id"]
            );
            $input = controle($data);
            addGame($input);
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
