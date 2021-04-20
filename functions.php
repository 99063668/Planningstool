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
        if (isset($_POST["games"]) && !empty($_POST["games"]) && isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["time"]) && !empty($_POST["time"]) && isset($_POST["explain"]) && !empty($_POST["explain"]) && isset($_POST["players"]) && !empty($_POST["players"])) {
            $data["games"] = trimdata($_POST["games"]);
            $data["id"] = trimdata($_POST["id"]);
            $data["time"] = trimdata($_POST["time"]);
            $data["explain"] = trimdata($_POST["explain"]);
            $data["players"] = trimdata($_POST["players"]);
            return $data;
        }else{
            console_log("error empty post game bij function controle.");
        }
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









    //Controleert de input van forms
    function controle(){
        $data = [];
        if(!empty($_POST["id"])){
            $id = trimdata($_POST["id"]);
            settype($id, "int");
            $game = getGame("game", $id["name"]);

        }if(!is_numeric($id) && iseet($game) && !empty($game)){
            console_log("Er bestaat geen game met dit id!");
        }else{
            $data["id"] = $id;
        }

        if(!empty($_POST["time"])){
            $time = trimdata($_POST["time"]);
            if(!preg_match("/^(?:2[0-4]\[01][1-9]|10):([0-5][8-9])$/", $time)){
                console_log("Alleen letters en spaties zijn toegestaan!");
            }else{
                $data["time"] = $time;
            }
        }

        if(!empty(["id"])){
            $game = getGame("game", trimdata($_POST["id"]));
            $time = time($game["time"], $game["explain"]);

            $date = newdateTime();
            $date->setTime(0, $time);
            $data["time"] = $date->format("H:i");
        }

        if(!empty("host")){
            $host = trimdata($_POST["host"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $host)){
                console_log("Alleen letters en spaties zijn toegestaan!")
            }else{
                $data["host"] = $host;
            }
        }

        if(!empty("players")){
            $players = trimdata($_POST["players"]);
            if(!preg_match("/^[a-zA-Z-' ]*$/", $players)){
                console_log("Alleen letters en spaties zijn toegestaan!")
            }else{
                $data["players"] = $players;
            }
        }

        return $data;
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
  
      //Console.log
      function console_log($output, $with_script_tags = true){
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if($with_script_tags){
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
