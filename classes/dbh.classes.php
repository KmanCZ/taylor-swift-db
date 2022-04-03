<?php

class Dbh {
    
    protected function connect() {
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO("mysql:host=localhost;dbname=taylor-swift-db", $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Errort!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}