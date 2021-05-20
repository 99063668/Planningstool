<?php 
    $HostErr = $PlayerErr = "";
    $host = $players = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST["Host"];
    $players = $_POST["Player"];

        if (empty($_POST["Host"])) {
            $HostErr = "Host is verplicht";
        } else {
            $host = input($_POST["Host"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$host)) {
            $HostErr = "Alleen letters en spaties zijn toegestaan";
            }
        }
    }
    if (empty($_POST["Player"])) {
        $PlayerErr = "Player is verplicht";
    } else {
        $players = input($_POST["Player"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$players)) {
        $PlayerErr = "Alleen letters en spaties zijn toegestaan";
        }
    }

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>