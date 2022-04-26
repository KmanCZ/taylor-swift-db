<?php

class Dbh {
    
    protected function connect() {
        try {
            $username = "root";
            //$username = "epiz_31596274";
            $password = "";
            //$password = "RrgfskFTaQhF";
            $dbh = new PDO("mysql:host=localhost;dbname=taylor-swift-db", $username, $password);
            //$dbh = new PDO("mysql:host=sql113.epizy.com;dbname=epiz_31596274_TaylorSwiftDb", $username, $password);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $dbh;
        } catch (PDOException $e) {
            print "Errort!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}