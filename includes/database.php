<?php
    function openDatabase(){
            $host = "localhost";
            $username = "root";
            $password = "mysql";
            $database = "planningstool";

            try {
                $connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connect;
            } catch (PDOException $error) {
                echo "Database connection failed: ".$error->getMessage();
                echo "<br>";
            }
        }
?>
