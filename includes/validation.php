<?php 
    $hostErr = $playerErr = "";
    $host = $players = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST["host"];
    $players = $_POST["player"];

        if (empty($_POST["host"])) {
            $hostErr = "host is verplicht";
        } else {
            $host = input($_POST["host"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$host)) {
            $hostErr = "Alleen letters en spaties zijn toegestaan";
            }
        }
    }

    if (empty($_POST["player"])) {
        $playerErr = "player is verplicht";
    } else {
        $players = input($_POST["player"]);
        if (!preg_match("/^[a-zA-Z-', ]*$/",$players)) {
        $playerErr = "Alleen letters en spaties zijn toegestaan";
        }
    }

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
