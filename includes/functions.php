<?php
    include("database.php");

    function getAllGames(){
        $conn = openDatabase();
        $query = $conn->prepare("SELECT * FROM games");
        $query->execute();
        return $query->fetchAll();
    }

    function getGame($id){
        $conn = openDatabase();
        $query = $conn->prepare("SELECT * FROM games WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        return $query->fetch();
    }