<?php

class Dbh {
    
    protected function connect() {
        try {
            $username = "root";
            $password = "";
            $dbh = new PDO("mysql:host=localhost;dbname=taylor-swift-db", $username, $password);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $dbh;
        } catch (PDOException $e) {
            print "Errort!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}